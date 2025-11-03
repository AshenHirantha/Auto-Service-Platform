<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAlert extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inventory_id',
        'alert_type',
        'status',
        'generated_at',
        'resolved_at',
        'resolution',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'generated_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the inventory item that generated the alert.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}