<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function file(Product $product)
    {
        return view('product.file', compact('product'));
    }


}
