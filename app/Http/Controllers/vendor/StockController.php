<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Support\Facades\Schema;
use App\Models\PartsInventory;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // Join Parts with their inventory
        $query = Part::query();
        if (Schema::hasTable('parts_inventories')) {
            $query->leftJoin('parts_inventories', 'parts.id', '=', 'parts_inventories.part_id')
                ->addSelect('parts.*', 'parts_inventories.quantity as stock_qty', 'parts_inventories.availability as stock_availability');
        } else {
            $query->select('parts.*');
        }

        $parts = $query->paginate(20);

        return view('vendor.stock.index', compact('parts'));
    }

    public function update(Request $request, Part $product)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:0']]);

        $vendorId = optional($request->user()->partsVendor)->id;
        $inv = PartsInventory::firstOrCreate([
            'part_id' => $product->id,
            'vendor_id' => $vendorId,
        ]);
        $inv->quantity = $data['quantity'];
        $inv->save();

        return back()->with('success', 'Stock updated.');
    }
}
