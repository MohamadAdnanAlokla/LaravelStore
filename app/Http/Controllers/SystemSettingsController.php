<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSettings;

class SystemSettingsController extends Controller
{
    public function index()
{
    $systemSettings = SystemSettings::first();
    $setting= $systemSettings ;
    $languages = ['en', 'fr', 'ar']; // Replace with your actual language options
    return view('admin.system_settings', compact('systemSettings', 'languages','setting'));
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'website_name' => 'required',
            'website_title' => 'required',
            'slogan' => 'required',
            'system_email' => 'required',
            'youtube_channel' => 'required',
            'store' => 'required',
            'purchase_code' => 'required',
        ]);

        $systemSettings = SystemSettings::firstOrNew([]);
        $systemSettings->website_name = $request->input('website_name');
        $systemSettings->website_title = $request->input('website_title');
        $systemSettings->website_keywords = $request->input('website_keywords');
        $systemSettings->website_description = $request->input('website_description');
        $systemSettings->author = $request->input('author');
        $systemSettings->slogan = $request->input('slogan');
        $systemSettings->system_email = $request->input('system_email');
        $systemSettings->address = $request->input('address');
        $systemSettings->phone = $request->input('phone');
        $systemSettings->facebook_url = $request->input('facebook_url');
        $systemSettings->linkedin_url = $request->input('linkedin_url');
        $systemSettings->youtube_channel = $request->input('youtube_channel');
        $systemSettings->store = $request->input('store');
        $systemSettings->purchase_code = $request->input('purchase_code');
        $systemSettings->language = $request->input('language');
        $systemSettings->footer_text = $request->input('footer_text');
        $systemSettings->footer_link = $request->input('footer_link');
        $systemSettings->save();

        session()->flash('success', 'تم حفظ الإعدادات بنجاح.');

        return redirect()->back();
    }

    public function update(Request $request)
{
    $validatedData = $request->validate([
        'website_name' => 'required',
        'website_title' => 'required',
        'slogan' => 'required',
        'system_email' => 'required',
        'youtube_channel' => 'required',
        'store' => 'required',
        'purchase_code' => 'required',
    ]);

    $systemSettings = SystemSettings::firstOrNew([]);
    $systemSettings->website_name = $request->input('website_name');
    $systemSettings->website_title = $request->input('website_title');
    $systemSettings->website_keywords = $request->input('website_keywords');
    $systemSettings->website_description = $request->input('website_description');
    $systemSettings->author = $request->input('author');
    $systemSettings->slogan = $request->input('slogan');
    $systemSettings->system_email = $request->input('system_email');
    $systemSettings->address = $request->input('address');
    $systemSettings->phone = $request->input('phone');
    $systemSettings->facebook_url = $request->input('facebook_url');
    $systemSettings->linkedin_url = $request->input('linkedin_url');
    $systemSettings->youtube_channel = $request->input('youtube_channel');
    $systemSettings->store = $request->input('store');
    $systemSettings->purchase_code = $request->input('purchase_code');
    $systemSettings->language = $request->input('language');
    $systemSettings->footer_text = $request->input('footer_text');
    $systemSettings->footer_link = $request->input('footer_link');
    $systemSettings->save();

    session()->flash('success', 'تم تحديث الإعدادات بنجاح.');

    return redirect()->back();
}

    public function destroy()
    {
        $systemSettings = SystemSettings::firstOrNew([]);
        $systemSettings->delete();

        session()->flash('success', 'تم حذف الإعدادات بنجاح.');

        return redirect()->back();
    }
}
