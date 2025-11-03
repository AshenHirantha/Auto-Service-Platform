<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'type',
        'file_url',
        'expiry_date',
        'upload_date',
        'is_verified',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiry_date' => 'date',
        'upload_date' => 'date',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the vehicle that owns the document.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}