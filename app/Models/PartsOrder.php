<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartsOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'vendor_id',
        'order_date',
        'total_amount',
        'status',
        'shipping_address',
        'tracking_info',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the user that placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the vendor that fulfills the order.
     */
    public function vendor()
    {
        return $this->belongsTo(PartsVendor::class);
    }

    /**
     * Get the order items for this order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the payment transactions for this order.
     */
    public function paymentTransactions()
    {
        return $this->morphMany(PaymentTransaction::class, 'reference');
    }

    public function items() 
    { 
        return $this->hasMany(\App\Models\OrderItem::class, 'parts_order_id'); 
    }
}