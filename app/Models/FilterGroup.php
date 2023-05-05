<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\HasTranslations;

class FilterGroup extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    public function filters()
    {
        return $this->hasMany(Filter::class);
    }
}
