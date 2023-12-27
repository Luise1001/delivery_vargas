<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zelle_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'email',
        'owner_name'
    ];
}
