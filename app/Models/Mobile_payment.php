<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bank;
use App\Models\Commerce;

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

    public function Bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function Commerce()
    {
        return $this->belongsTo(Commerce::class);
    }
}

