<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    public function recalculateTotals(){
        $this->subtotal = $this->items->sum('subtotal');
        $this->tax = $this->items->sum('tax');
        $this->total = $this->items->sum('total');
    }

    public function withOrderItemOptions(){
        $this->items->each(function($item){
            $item->optionGroups = $item->getGroupedVariantOptions();
        });

        return $this;
    }
}
