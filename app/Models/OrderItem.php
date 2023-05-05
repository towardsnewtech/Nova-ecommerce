<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
    ];

    public static function boot(): void
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->price = $model->variant->price;
            $model->tax_id = $model->product->tax->id;
            $model::recalculateTotal($model);
        });

        static::updating(function ($model) {
            $model::recalculateTotal($model);
        });
    }

    public static function recalculateTotal ($model)
    {
        $model->subtotal = $model->price * $model->quantity;
        $model->tax = Tax::find($model->tax_id)->rate * $model->subtotal;
        $model->total = $model->subtotal + $model->tax;
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class)->withPivot(['price']);
    }

    public function getGroupedVariantOptions()
    {
        $options = $this->variant->options->groupBy('group_id');
        $grouped = [];
        foreach ($options as $group_id => $group) {
            $g = OptionGroup::find($group_id);
            $grouped[$group_id] = [
                'id' => $group_id,
                'name' => $g->name,
                'multiple'=> $g->multiple,
                'required'=> $g->required,
                'options' => $group->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'name' => $option->name,
                        'price' => $option->pivot->price,
                    ];
                })->toArray(),
            ];
        }
        return $grouped;
    }

}
