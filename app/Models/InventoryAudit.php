<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAudit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inventory_id',
        'audit_date',
        'system_quantity',
        'actual_quantity',
        'discrepancy',
        'reason',
        'value_impact',
        'conducted_by',
        'status',
        'resolution',
        'resolved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'audit_date' => 'datetime',
        'resolved_at' => 'datetime',
        'system_quantity' => 'integer',
        'actual_quantity' => 'integer',
        'discrepancy' => 'integer',
        'value_impact' => 'decimal:2',
    ];

    /**
     * Get the inventory item that was audited.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}