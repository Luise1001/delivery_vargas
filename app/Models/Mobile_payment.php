<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'document_type',
        'document',
        'phone',
        'bank_id'
    ];
}
