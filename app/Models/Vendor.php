<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Vendor extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'vendor';

    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_name',
        'shop_slug',
        'logo',
        'banner',
        'address',
        'city',
        'country',
        'postal_code',
        'phone',
        'description',
        'is_verified',
        'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    // 🧭 Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // public function earnings()
    // {
    //     return $this->hasMany(VendorEarning::class);
    // }
}
