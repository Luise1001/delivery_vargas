<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'code',
        'description',
        'brand',
        'photo',
        'price',
        'full_price',
        'tax',
        'weight',
        'commerce_id',
        'category_id'
    ];
}
