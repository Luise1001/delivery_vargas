<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amount_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'full_amount',
        'tax',
        'payment_option_id',
        'paid',
        'status'
    ];
}
