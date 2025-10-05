<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];


    // Relation with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relation with SubSubCategory
    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class, 'sub_category_id', 'id');
    }
}
