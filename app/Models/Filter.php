<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\HasTranslations;

class Filter extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    public function filterGroup()
    {
        return $this->belongsTo(FilterGroup::class);
    }
}
