<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartsInventory extends Model
{
    use HasFactory;

    protected $table = 'parts_inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'part_id',
        'vendor_id',
        'quantity',
        'price',
        'condition',
        'availability',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the part that belongs to the inventory.
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Get the vendor that maintains the inventory.
     */
    public function vendor()
    {
        return $this->belongsTo(PartsVendor::class);
    }
}
