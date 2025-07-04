<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\Commerce;
use App\Models\Category;

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
        'category_id',
        'disabled',
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}

