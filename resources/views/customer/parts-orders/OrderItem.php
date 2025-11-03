<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PartsOrder;
use App\Models\Part;


class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parts_order_id',
        'part_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(PartsOrder::class, 'parts_order_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}