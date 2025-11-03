<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'category',
        'manufacturer',
        'model_compatibility',
        'specifications',
        'is_genuine',
        'warranty',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_genuine' => 'boolean',
    ];

    /**
     * Get the images for the part.
     */
    public function images()
    {
        return $this->hasMany(PartImage::class);
    }

    /**
     * Get the inventory entries for this part.
     */
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'item_id')
            ->where('item_type', 'Part');
    }

    /**
     * Get the parts inventory entries for this part.
     */
    public function partsInventory()
    {
        return $this->hasMany(PartsInventory::class);
    }

    /**
     * Get the order items for this part.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the service instances where this part was used.
     */
    public function partsUsed()
    {
        return $this->hasMany(PartsUsed::class);
    }

    /**
     * Get the warranties for this part.
     */
    public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }

    /**
     * Get the warranties for this part.
     */
    
}