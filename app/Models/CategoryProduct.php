<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\HasTranslations;

class CategoryProduct extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'description'];

    public function products(){
        return $this->belongsToMany(Product::class,'category_products','category_id','product_id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id');
    }
}
