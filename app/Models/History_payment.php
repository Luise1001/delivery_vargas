<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commerce_id',
        'payment_option_id',
        'amount',
         'reference',
         'order_id',
         'express_id',
         'verified' ,
         'currency_id'
    ];
}
