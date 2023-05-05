<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \App\Traits\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use \Spatie\Tags\HasTags;
    use HasTranslations;

    public $translatable = ['name', 'description'];

    public function category(){
        return $this->belongsToMany(Category::class,'category_products','product_id','category_id');
    }

    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function tax(){
        return $this->belongsTo(Tax::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
    }

    public function filters(){
        return $this->belongsToMany(Filter::class,'filter_product','product_id','filter_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large-size')
        ->width(1024)
        ->height(768);
        
        $this->addMediaConversion('medium-size')
        ->width(768)
        ->height(576);

        $this->addMediaConversion('thumb')
        ->width(368)
        ->height(232);
    }


}
