<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\HasTranslations;

class Tax extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'percentage',
        'isDefault',
    ];

    public function getRateAttribute()
    {
        return $this->percentage/100;
    }
}
