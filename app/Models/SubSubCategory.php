<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    protected $guarded = [];

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship to SubCategory
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
