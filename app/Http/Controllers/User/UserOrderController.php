<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function order()
    {
        $user = Auth::user();
        $products = Product::join('variations', 'products.id', '=', 'variations.product_id')
        ->join('colors', 'variations.color_id', '=', 'colors.id')
        ->select('products.*', 'variations.price', 'colors.name as color_name')
        ->get();
        return view('user.orders.index', compact('products'));
    }
}
