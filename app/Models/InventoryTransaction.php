<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inventory_id',
        'transaction_type',
        'quantity',
        'unit_price',
        'reference_type',
        'reference_id',
        'reason',
        'authorized_by',
        'transaction_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'transaction_date' => 'datetime',
        'quantity' => 'integer',
    ];

    /**
     * Get the inventory item that owns the transaction.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    /**
     * Get the reference model for this transaction.
     */
    public function reference()
    {
        return $this->morphTo();
    }
}