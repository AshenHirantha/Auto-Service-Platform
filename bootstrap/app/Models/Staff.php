<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'station_id',
        'name',
        'role',
        'specialization',
        'schedule',
        'rating',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'float',
    ];

    /**
     * Get the service station that employs the staff member.
     */
    public function serviceStation()
    {
        return $this->belongsTo(ServiceStation::class, 'station_id');
    }

    /**
     * Get the service history records where this staff member was the mechanic.
     */
    public function serviceHistory()
    {
        return $this->hasMany(ServiceHistory::class, 'mechanic_id');
    }
}