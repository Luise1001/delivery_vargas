<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'document_type',
        'document',
        'bank_id',
        'account_number'
    ];
}
