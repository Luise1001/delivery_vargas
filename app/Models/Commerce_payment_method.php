<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentOption;
use App\Models\Commerce;

class Commerce_payment_method extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'payment_option_id',
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class, 'commerce_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentOption::class, 'payment_option_id');
    }
}
