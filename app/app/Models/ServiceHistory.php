<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'service_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'service_request_id',
        'service_station_id',
        'mechanic_id',
        'service_date',
        'mileage_at_service',
        'service_type',
        'diagnosis',
        'recommendations',
        'labor_cost',
        'parts_cost',
        'total_cost',
        'quality_check',
        'warranty_info',
        'next_service_due',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'service_date' => 'datetime',
        'next_service_due' => 'datetime',
        'labor_cost' => 'decimal:2',
        'parts_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'mileage_at_service' => 'integer',
    ];

    /**
     * Get the vehicle that owns the service history.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the service request that created this service history.
     */
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    /**
     * Get the service station that performed the service.
     */
    public function serviceStation()
    {
        return $this->belongsTo(ServiceStation::class, 'service_station_id');
    }

    /**
     * Get the mechanic who performed the service.
     */
    public function mechanic()
    {
        return $this->belongsTo(Staff::class, 'mechanic_id');
    }

    /**
     * Get the parts used in this service.
     */
    public function partsUsed()
    {
        return $this->hasMany(PartsUsed::class);
    }

    /**
     * Get the warranties that cover this service.
     */
    public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }

    /**
     * Get the images documenting this service.
     */
    public function serviceImages()
    {
        return $this->hasMany(ServiceImage::class);
    }
}