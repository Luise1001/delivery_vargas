<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bank;
use App\Models\Commerce;

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

    public function Bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function Commerce()
    {
        return $this->belongsTo(Commerce::class);
    }
}
