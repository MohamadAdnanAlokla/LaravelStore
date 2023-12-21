<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';


    protected $fillable = [
        'variation_id',
        'start_date',
        'end_date',
        'discount',
    ];

    // Define the relationship between Discount and Variation (assuming Variation model exists)
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
