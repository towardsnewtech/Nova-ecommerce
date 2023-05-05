<?php

namespace Eshop\OrderBuilder\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;

class ProductVariantController extends Controller
{
    public function getAllByProduct(Request $request, $product_id)
    {
        return Product::find($product_id)->variants;
    }

    public function getItemByProduct(Request $request, $id, $product_id)
    {
        return Product::find($product_id)->variants->find($id);
    }
}
