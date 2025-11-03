<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_history_id',
        'part_id',
        'warranty_type',
        'start_date',
        'end_date',
        'terms',
        'coverage',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the service history that is covered by the warranty.
     */
    public function serviceHistory()
    {
        return $this->belongsTo(ServiceHistory::class);
    }

    /**
     * Get the part that is covered by the warranty.
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}