<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location_id',
        'item_type',
        'item_id',
        'item_name',
        'SKU',
        'barcode',
        'current_stock',
        'minimum_stock',
        'reorder_point',
        'maximum_stock',
        'unit_cost',
        'selling_price',
        'storage_location',
        'condition',
        'expiry_date',
        'batch_number',
        'quality_status',
        'last_stock_check',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_cost' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'expiry_date' => 'datetime',
        'last_stock_check' => 'datetime',
        'current_stock' => 'integer',
        'minimum_stock' => 'integer',
        'reorder_point' => 'integer',
        'maximum_stock' => 'integer',
    ];

    /**
     * Get the service station that the inventory belongs to.
     */
    public function serviceStation()
    {
        return $this->belongsTo(ServiceStation::class, 'location_id');
    }

    /**
     * Get the item that belongs to the inventory.
     */
    public function item()
    {
        return $this->morphTo();
    }

    /**
     * Get the transactions for this inventory item.
     */
    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    /**
     * Get the stock alerts for this inventory item.
     */
    public function stockAlerts()
    {
        return $this->hasMany(StockAlert::class);
    }

    /**
     * Get the audits for this inventory item.
     */
    public function audits()
    {
        return $this->hasMany(InventoryAudit::class);
    }
}