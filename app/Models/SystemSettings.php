<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    protected $table = 'system_settings';
    public $timestamps = false;

    protected $fillable = [
        'website_name',
        'website_title',
        'website_keywords',
        'website_description',
        'author',
        'slogan',
        'system_email',
        'address',
        'phone',
        'facebook_url',
        'linkedin_url',
        'youtube_channel',
        'store',
        'purchase_code',
        'language',
        'footer_text',
        'footer_link'
    ];
}
