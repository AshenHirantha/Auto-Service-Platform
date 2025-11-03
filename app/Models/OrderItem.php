<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'part_id',
        'quantity',
        'unit_price',
        'discount',
        'tax',
        'subtotal',
        'status',
        'estimated_delivery',
        'actual_delivery',
        'serial_number',
        'batch_number',
        'notes',
        'is_warranty_applied',
        'warranty_start_date',
        'warranty_end_date',
        'quality_checked',
        'quality_status',
        'return_reason',
        'is_cancelled',
        'cancelled_at',
        'cancellation_reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'estimated_delivery' => 'datetime',
        'actual_delivery' => 'datetime',
        'warranty_start_date' => 'datetime',
        'warranty_end_date' => 'datetime',
        'is_warranty_applied' => 'boolean',
        'quality_checked' => 'boolean',
        'is_cancelled' => 'boolean',
        'cancelled_at' => 'datetime',
        'quantity' => 'integer',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(PartsOrder::class, 'order_id');
    }

    /**
     * Get the part that is ordered.
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Get the status history for this order item.
     */
    public function statusHistory()
    {
        return $this->hasMany(OrderItemStatus::class);
    }

    /**
     * Get the return requests for this order item.
     */
    public function returnRequests()
    {
        return $this->hasMany(ReturnRequest::class);
    }

    public function status() 
    { 
        return $this->belongsTo(\App\Models\OrderItemStatus::class, 'status_id'); 
    }
}