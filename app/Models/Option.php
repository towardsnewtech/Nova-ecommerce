<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\HasTranslations;

class Option extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'price',
        'variant_id',
    ];

    public function optionGroup(){
        return $this->belongsTo(OptionGroup::class, 'group_id');
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class)->withPivot('price');
    }

    public function parent()
    {
        return $this->optionGroup();
    }
}
