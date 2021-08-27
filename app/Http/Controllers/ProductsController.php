<?php

namespace App\Http\Controllers;

use App\Models\Products;

class ProductsController extends Controller
{
    public function getAllProducts(): \Illuminate\Http\JsonResponse
    {
        $products = Products::all();
        return response()->json($products);
    }
}
