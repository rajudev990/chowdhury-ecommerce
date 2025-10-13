<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

  
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');

    }

    // Define the relationship with ProductCommision model
    public function commission()
    {
        return $this->hasOne(ProductCommision::class);
    }

    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    // Category-এর অন্য products (same category, except current)
    // Related products (same category, exclude current product)
    public function relatedProducts()
    {
        return $this->category
            ? $this->category->products()->where('id', '!=', $this->id)->get()
            : collect();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
