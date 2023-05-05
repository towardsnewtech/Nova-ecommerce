<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\HasTranslations;

class Variant extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'description'];

    public function parent() {
        return $this->product();
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function options(){
        return $this->belongsToMany(Option::class)->withPivot('price');
    }

    public function getOptionPrices()
    {
        foreach($this->options as $option){
            $prices[$option->id] = $option->pivot->price;
        }

        return $prices;
    }
}
