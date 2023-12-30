<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
