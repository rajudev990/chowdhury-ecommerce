<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $guarded = [];

    // Wishlist belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Wishlist belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
