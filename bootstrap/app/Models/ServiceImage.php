<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_history_id',
        'image_type',
        'image_url',
        'description',
        'captured_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'captured_at' => 'datetime',
    ];

    /**
     * Get the service history that owns the image.
     */
    public function serviceHistory()
    {
        return $this->belongsTo(ServiceHistory::class);
    }
}