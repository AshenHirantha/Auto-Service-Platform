<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supplier_id',
        'item_id',
        'supplier_price',
        'lead_time',
        'minimum_order_quantity',
        'supplier_SKU',
        'bulk_discount_threshold',
        'bulk_discount_percent',
        'is_preferred_supplier',
        'contract_terms',
        'contract_expiry',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'supplier_price' => 'decimal:2',
        'lead_time' => 'integer',
        'minimum_order_quantity' => 'integer',
        'bulk_discount_threshold' => 'float',
        'bulk_discount_percent' => 'float',
        'is_preferred_supplier' => 'boolean',
        'contract_expiry' => 'date',
    ];

    /**
     * Get the supplier (parts vendor) that owns the inventory.
     */
    public function supplier()
    {
        return $this->belongsTo(PartsVendor::class, 'supplier_id');
    }
}