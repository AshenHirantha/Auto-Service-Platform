<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'specialization',
        'qualifications',
        'rating',
        'availability',
        'hourly_rate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'float',
        'hourly_rate' => 'decimal:2',
    ];

    /**
     * Get the consultations provided by the expert.
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}