<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Variation;
use App\Models\SystemSettings;

class HomeController extends Controller
{
    public function index()
    {
        $setting = SystemSettings::first();

        $categories = Category::all();
        $products = Product::join('variations', 'products.id', '=', 'variations.product_id')
        ->join('colors', 'variations.color_id', '=', 'colors.id')
        ->select('products.*', 'variations.price', 'colors.name as color_name')
        ->get();

        return view('index', compact('categories','products','setting'));
    }
    public function showLogin()
    {
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('login', compact('categories','setting'));
    }

    public function showRegister()
    {
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('register', compact('categories','setting'));
    }

    public function shop()
    {
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('shop', compact('categories','setting'));
    }

    public function detail()
    {
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('detail', compact('categories','setting'));
    }

    public function cart()
    {
        
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('cart', compact('categories','setting'));
    }

    public function checkout()
    {
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('checkout', compact('categories','setting'));
    }

    public function contact()
    {
        $setting = SystemSettings::first();
        $categories = Category::all();
        return view('contact', compact('categories','setting'));
    }


}
