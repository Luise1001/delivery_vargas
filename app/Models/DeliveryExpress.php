<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryExpress extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'route_id',
        'personal',
        'comercial',
        'user_id',
        'commerce_id',
        'amount',
        'paid',
        'status',
        'comment',
        'driver_id',
        'updated_by'
    ];
}
