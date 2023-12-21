<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;
use App\Models\SystemSettings;

class VariationController extends Controller
{
    public function create()
    {
        $products = \App\Models\Product::all();
        $colors = \App\Models\Color::all();
        $variations = \App\Models\Variation::all();
        $setting = SystemSettings::first();
        return view('admin.variations', compact('products', 'colors', 'variations','setting'));
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'color_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);

        Variation::create($validatedData);

        return redirect()->route('variations.create');     

    }

    public function edit(Variation $variation)
    {
        $products = \App\Models\Product::all();
        $colors = \App\Models\Color::all();
    
        return view('admin.variation_edit', compact('variation', 'products', 'colors'));
    }
    
    public function update(Request $request, Variation $variation)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'color_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);
    
        $variation->update($validatedData);
    
        // تنفيذ العمليات المطلوبة بعد التعديل بنجاح (مثل التوجيه أو إظهار رسالة)
        return redirect()->route('variations.create')->with('success', 'Variation updated successfully');
    }
    

    public function delete(Variation $variation)
    {
        $variation->delete();
        return redirect()->route('variations.create');   

        // تنفيذ العمليات المطلوبة بعد الحذف بنجاح (مثل التوجيه أو إظهار رسالة)
    }
}
