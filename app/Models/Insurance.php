<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'provider',
        'policy_number',
        'start_date',
        'end_date',
        'premium',
        'coverage',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'premium' => 'decimal:2',
    ];

    /**
     * Get the vehicle that owns the insurance.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}