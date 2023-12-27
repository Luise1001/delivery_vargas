<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce_payment_method extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'payment_option_id'
    ];
}
