<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;
use App\Models\SystemSettings;
class ProductController extends Controller
{


    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $setting = SystemSettings::first();
        return view('admin.products', compact('products', 'categories','setting'));
    }
    

    public function create()
    {
        $categories = Category::all(); // استرداد جميع الفئات
        return view('admin.products', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products_edit', compact('product', 'categories'));
    }    

    

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
