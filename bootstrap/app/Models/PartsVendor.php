<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartsVendor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'contact',
        'tax_info',
        'rating',
        'is_verified',
        'business_hours',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'float',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the parts inventory for this vendor.
     */
    public function partsInventory()
    {
        return $this->hasMany(PartsInventory::class, 'vendor_id');
    }

    /**
     * Get the parts orders for this vendor.
     */
    public function partsOrders()
    {
        return $this->hasMany(PartsOrder::class, 'vendor_id');
    }

    /**
     * Get the supplier inventory for this vendor.
     */
    public function supplierInventory()
    {
        return $this->hasMany(SupplierInventory::class, 'supplier_id');
    }
}