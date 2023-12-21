<?php

namespace App\Http\Controllers;
use App\Models\SystemSettings;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function create()
    {
        $setting = SystemSettings::first();
       return view('admin.colors', compact('setting'));
    }

    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'name' => 'required',
            'hex_code' => 'required',
        ]);

        $color = Color::create($validatedData);

        if ($color) {
            return redirect()->route('colors.index')->with('success', 'Color created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create color.');
        }
        
    }
    

    public function delete(Color $color)
    {
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'Color deleted successfully.');
    }
}
