<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'plate',
        'model',
        'year_model',
        'driver_id',
        'created_by'
    ];
}
