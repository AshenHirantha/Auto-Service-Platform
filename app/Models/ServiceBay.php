<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBay extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'service_bays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'station_id',
        'name',
        'type',
        'status',
        'current_service',
    ];

    /**
     * Get the service station that owns the service bay.
     */
    public function serviceStation()
    {
        return $this->belongsTo(ServiceStation::class, 'station_id');
    }
}