<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_item_id',
        'request_date',
        'reason',
        'condition',
        'status',
        'resolution',
        'refund_amount',
        'return_shipping_label',
        'processed_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'request_date' => 'datetime',
        'processed_date' => 'datetime',
        'refund_amount' => 'decimal:2',
    ];

    /**
     * Get the order item that is being returned.
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}