<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'commerce_id',
        'quantity'
    ];
}
