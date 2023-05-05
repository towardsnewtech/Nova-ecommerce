<?php

namespace Eshop\OrderBuilder\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAll()
    {
        return Product::all();
    }

    public function getItem(Request $request, $id)
    {
        return Product::find($id);
    }
}