<?php

namespace Eshop\OrderBuilder\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;

class ProductVariantOptionsController extends Controller
{
    public function getAllByProductAndVariant(Request $request, $product_id, $variant_id)
    {
        return Product::find($product_id)->variants->find($variant_id)->options;
    }

    public function getAllOrganizedByProductAndVariant(Request $request, $product_id, $variant_id)
    {
        $options = Product::find($product_id)->variants->find($variant_id)->options;
        $organized = [];
        foreach ($options as $option) {
            $organized[$option->option_group_id][] = $option;
        }
        return $organized;
    }
}
