<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCommision extends Model
{
    protected $guarded = [];


    // If you need to define relationships with the Product model, you can do it here.
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
