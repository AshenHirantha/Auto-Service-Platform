<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'service_stations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'contact',
        'business_hours',
        'specializations',
        'rating',
        'is_verified',
        'tax_info',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'float',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the staff for the service station.
     */
    public function staff()
    {
        return $this->hasMany(Staff::class, 'station_id');
    }

    /**
     * Get the service bays for the service station.
     */
    public function serviceBays()
    {
        return $this->hasMany(ServiceBay::class, 'station_id');
    }

    /**
     * Get the inventory for the service station.
     */
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'location_id');
    }

    /**
     * Get the service requests for the service station.
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'station_id');
    }
}