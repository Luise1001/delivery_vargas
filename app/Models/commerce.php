<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commerce extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'document',
        'name',
        'phone',
        'active'
    ];
}
