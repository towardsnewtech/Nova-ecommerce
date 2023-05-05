<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function products(){
        return $this->hasManyThrough(Product::class,OrderItem::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
	public function Store(){
        return $this->belongsTo(Store::class);
    }
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
