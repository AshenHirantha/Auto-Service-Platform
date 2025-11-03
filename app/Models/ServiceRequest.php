<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'station_id',
        'request_date',
        'status',
        'description',
        'estimated_cost',
        'final_cost',
        'completion_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'request_date' => 'datetime',
        'completion_date' => 'datetime',
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2',
    ];

    /**
     * Get the vehicle that owns the service request.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the service station that handles the service request.
     */
    public function serviceStation()
    {
        return $this->belongsTo(ServiceStation::class, 'station_id');
    }

    /**
     * Get the service history associated with this service request.
     */
    public function serviceHistory()
    {
        return $this->hasOne(ServiceHistory::class);
    }

    /**
     * Get the parts used for this service request.
     */
    public function partsUsed()
    {
        return $this->hasManyThrough(PartsUsed::class, ServiceHistory::class);
    }

    /**
     * Get the payment transactions for this service request.
     */
    public function paymentTransactions()
    {
        return $this->morphMany(PaymentTransaction::class, 'reference');
    }

    /**
     * Get the user that owns the service request through the vehicle.
     */
    public function user()
    {
        return $this->hasOneThrough(User::class, Vehicle::class, 'id', 'id', 'vehicle_id', 'user_id');
    }
}