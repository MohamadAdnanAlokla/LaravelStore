<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'variation_id',
        'rating',
        'comment',
    ];

    // تعريف العلاقة بين الريفيو وجدول المستخدمين (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // تعريف العلاقة بين الريفيو وجدول التفاصيل الخاصة بالمنتج (Variation)
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
