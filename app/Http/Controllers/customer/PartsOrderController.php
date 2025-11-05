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
                    'shipping_address' => null,
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
                    ]);
                }
            }
        });

        Session::forget('parts_cart');

        return redirect()->route('customer.orders.index')->with('status', 'Order request sent to vendor(s).');
    }

}
