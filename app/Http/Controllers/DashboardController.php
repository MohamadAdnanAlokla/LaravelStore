<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSettings;
class DashboardController extends Controller
{
    public function index()
    {   $setting = SystemSettings::first();
        return view('admin.dashboard',compact('setting'));
    }
}
