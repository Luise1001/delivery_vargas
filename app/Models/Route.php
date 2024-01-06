<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'service_id',
        'from',
        'to',
        'distance',
        'duration',
        'url_map'
    ];
}
