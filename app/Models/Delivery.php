<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'route_id',
        'commerce_id',
        'user_id',
        'driver_id',
        'amount',
        'paid',
        'status'
    ];
}
