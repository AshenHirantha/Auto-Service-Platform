<?php

namespace App\Http\Controllers\customer;

use App\Models\PartsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\PartsInventory;
use App\Models\PartsVendor;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PartsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = PartsOrder::where('user_id', Auth::id())->latest()->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = PartsOrder::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        return view('customer.orders.show', compact('order'));
    }

    public function browse(Request $request)
    {
        $q = $request->string('q')->toString();
        $inventories = PartsInventory::with(['part', 'vendor'])
            ->when($q, function ($query) use ($q) {
                $query->whereHas('part', fn($p) =>
                    $p->where('name', 'like', "%{$q}%")
                    ->orWhere('model_compatibility', 'like', "%{$q}%"));
            })
            ->orderByDesc('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('customer.orders.browse', compact('inventories', 'q'));
    }

    public function addToCart(Request $request)
    {
        $data = $request->validate([
            'inventory_id' => ['required', 'integer', 'exists:parts_inventories,id'],
            'quantity'     => ['required', 'integer', 'min:1'],
        ]);

        $inventory = PartsInventory::with(['part', 'vendor'])->findOrFail($data['inventory_id']);

        $cart = Session::get('parts_cart', []);

        $vendorId = $inventory->vendor_id;
        $itemKey = (string)$inventory->id;

        if (!isset($cart[$vendorId])) {
            $cart[$vendorId] = [
                'vendor_id' => $vendorId,
                'vendor_name' => $inventory->vendor?->name ?? 'Vendor',
                'items' => [],
            ];
        }

        if (isset($cart[$vendorId]['items'][$itemKey])) {
            $cart[$vendorId]['items'][$itemKey]['quantity'] += (int)$data['quantity'];
        } else {
            $cart[$vendorId]['items'][$itemKey] = [
                'inventory_id' => $inventory->id,
                'part_id'      => $inventory->part_id,
                'part_name'    => $inventory->part?->name ?? 'Part',
                'unit_price'   => (float)$inventory->price,
                'quantity'     => (int)$data['quantity'],
                'available'    => (int)$inventory->quantity,
            ];
        }

        Session::put('parts_cart', $cart);

        return back()->with('status', 'Added to cart.');
    }

    public function cart()
    {
        $cart = Session::get('parts_cart', []);
        return view('customer.orders.cart', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('parts_cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        // Check for missing shipping addresses
        $missingShipping = [];
        foreach ($cart as $vendorId => $group) {
            if (empty($group['shipping_address'])) {
                $missingShipping[] = $group['vendor_name'] ?? ('Vendor #' . $vendorId);
            }
        }
        if (!empty($missingShipping)) {
            $msg = 'Please enter a shipping address ';
            return back()->withErrors(['shipping_address' => $msg])->withInput();
        }

        DB::transaction(function () use ($cart) {
            foreach ($cart as $vendorId => $group) {
                $total = 0.0;
                foreach ($group['items'] as $item) {
                    $total += ((float)$item['unit_price']) * ((int)$item['quantity']);
                }

                $order = PartsOrder::create([
                    'user_id'       => Auth::id(),
                    'vendor_id'     => $vendorId,
                    'order_date'    => now(),
                    'total_amount'  => $total,
                    'status'        => 'pending',
                    'shipping_address' => $group['shipping_address'] ?? null,
                    'tracking_info'    => null,
                ]);

                foreach ($group['items'] as $item) {
                    OrderItem::create([
                        'order_id'   => $order->id,
                        'part_id'    => $item['part_id'],
                        'quantity'   => (int)$item['quantity'],
                        'unit_price' => (float)$item['unit_price'],
                        'subtotal'   => ((float)$item['unit_price']) * ((int)$item['quantity']),
                        'status'     => 'pending',
                        'shipping_address' => $group['shipping_address'],
                        'tracking_info'    => null
                    ]);
                }
            }
        });

        Session::forget('parts_cart');

        return redirect()->route('customer.orders.index')->with('status', 'Order request sent to vendor(s).');
    }

    /**
     * Clear the cart session.
     */
    public function clearCart(): \Illuminate\Http\RedirectResponse
    {
        // Clear the cart only after the transaction is successful
        Session::forget('parts_cart');
        return back()->with('status', 'Cart cleared.');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function updateQuantity(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'vendor_id' => ['required', 'integer'],
            'item_key'  => ['required'],
            'quantity'  => ['required', 'integer', 'min:1'],
        ]);

        $cart = Session::get('parts_cart', []);
        $vendorId = $data['vendor_id'];
        $itemKey = $data['item_key'];
        $quantity = $data['quantity'];

        if (isset($cart[$vendorId]['items'][$itemKey])) {
            $available = $cart[$vendorId]['items'][$itemKey]['available'] ?? 1;
            $cart[$vendorId]['items'][$itemKey]['quantity'] = min($quantity, $available);
            Session::put('parts_cart', $cart);
            return back()->with('status', 'Quantity updated.');
        }

        return back()->withErrors(['cart' => 'Item not found in cart.']);
    }

    /**
     * Update the shipping address for a vendor group in the cart.
     */
    public function updateShippingAddress(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'vendor_id' => ['required', 'integer'],
            'shipping_address' => ['required', 'string', 'max:255'],
        ]);

        $cart = Session::get('parts_cart', []);
        $vendorId = $data['vendor_id'];
        $address = $data['shipping_address'];

        if (isset($cart[$vendorId])) {
            $cart[$vendorId]['shipping_address'] = $address;
            Session::put('parts_cart', $cart);
            return back()->with('status', 'Shipping address updated.');
        }

        return back()->withErrors(['cart' => 'Vendor not found in cart.']);
    }

}
