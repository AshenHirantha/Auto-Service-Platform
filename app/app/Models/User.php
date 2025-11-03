<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'phone_verified_at',
        'is_active',
        'user_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Define user types as constants
    const USER_TYPE_CUSTOMER = 'customer';
    const USER_TYPE_SERVICE_STATION = 'service_station';
    const USER_TYPE_VENDOR = 'vendor';
    const USER_TYPE_ADMIN = 'admin';

    public static function getUserTypes(): array
    {
        return [
            self::USER_TYPE_CUSTOMER => 'Customer',
            self::USER_TYPE_SERVICE_STATION => 'Service Station',
            self::USER_TYPE_VENDOR => 'Parts Vendor',
            self::USER_TYPE_ADMIN => 'Administrator',
        ];
    }

    // Relationships
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function serviceRequests()
    {
        return $this->hasManyThrough(ServiceRequest::class, Vehicle::class);
    }

    public function partsOrders()
    {
        return $this->hasMany(PartsOrder::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    // Service Station relationship (if user is service station owner)
    public function serviceStation()
    {
        return $this->hasOne(ServiceStation::class, 'owner_id');
    }

    // Parts Vendor relationship (if user is vendor)
    public function partsVendor()
    {
        return $this->hasOne(PartsVendor::class, 'owner_id');
    }

    // Scopes
    public function scopeCustomers($query)
    {
        return $query->where('user_type', self::USER_TYPE_CUSTOMER);
    }

    public function scopeServiceStations($query)
    {
        return $query->where('user_type', self::USER_TYPE_SERVICE_STATION);
    }

    public function scopeVendors($query)
    {
        return $query->where('user_type', self::USER_TYPE_VENDOR);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helper methods
    public function isCustomer(): bool
    {
        return $this->user_type === self::USER_TYPE_CUSTOMER;
    }

    public function isServiceStation(): bool
    {
        return $this->user_type === self::USER_TYPE_SERVICE_STATION;
    }

    public function isVendor(): bool
    {
        return $this->user_type === self::USER_TYPE_VENDOR;
    }

    public function isAdmin(): bool
    {
        return $this->user_type === self::USER_TYPE_ADMIN;
    }

    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Define which user types can access which panels
        switch ($panel->getId()) {
            case 'admin':
                return $this->isAdmin();
            case 'service-station':
                return $this->isServiceStation();
            case 'vendor':
                return $this->isVendor();
            case 'customer':
                return $this->isCustomer();
            default:
                return false;
        }
    }
}