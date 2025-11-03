<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'expert_id',
        'schedule_time',
        'status',
        'problem',
        'diagnosis',
        'cost',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'schedule_time' => 'datetime',
        'cost' => 'decimal:2',
    ];

    /**
     * Get the user that booked the consultation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the expert that provides the consultation.
     */
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    /**
     * Get the payment transactions for this consultation.
     */
    public function paymentTransactions()
    {
        return $this->morphMany(PaymentTransaction::class, 'reference');
    }
}