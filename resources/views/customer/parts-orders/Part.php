<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PartsVendor;



class Part extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'vendor_id',
        'image_url',
    ];

    public function vendor()
    {
        return $this->belongsTo(PartsVendor::class, 'vendor_id');
    }
}