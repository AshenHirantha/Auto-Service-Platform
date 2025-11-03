<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartsUsed extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_history_id',
        'part_id',
        'quantity',
        'unit_price',
        'total_price',
        'part_condition',
        'warranty_period',
        'replacement_reason',
        'installed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'installed_at' => 'datetime',
        'quantity' => 'integer',
    ];

    /**
     * Get the service history that used this part.
     */
    public function serviceHistory()
    {
        return $this->belongsTo(ServiceHistory::class);
    }

    /**
     * Get the part that was used.
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}