<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'registration_number',
        'make',
        'model',
        'year',
        'chassis_number',
        'fuel_type',
        'transmission_type',
        'purchase_date',
        'mileage',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_date' => 'date',
        'year' => 'integer',
        'mileage' => 'integer',
    ];

    /**
     * Get the user that owns the vehicle.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service requests for the vehicle.
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    /**
     * Get the service history for the vehicle.
     */
    public function serviceHistory()
    {
        return $this->hasMany(ServiceHistory::class);
    }

    /**
     * Get the documents for the vehicle.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the insurance policies for the vehicle.
     */
    public function insurance()
    {
        return $this->hasMany(Insurance::class);
    }
}