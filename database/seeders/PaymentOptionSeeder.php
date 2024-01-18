<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentOption;
use App\Models\Commerce_payment_method;

class PaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentOption::create([
          'id'=> 1,
          'name'=> 'Efectivo VES',
          'target_table' => 'cash_payments_bs',
          'created_by' => 1,
        ]);
        PaymentOption::create([
          'id'=> 2,
          'name'=> 'Efectivo USD',
          'target_table' => 'cash_payments_usd',
          'created_by' => 1,
        ]);
        PaymentOption::create([
          'id'=> 3,
          'name'=> 'Pago Móvil',
          'target_table' => 'mobile_payments',
          'created_by' => 1,
        ]);
        PaymentOption::create([
          'id'=> 4,
          'name'=> 'Transferencia',
          'target_table' => 'transfer_payments',
          'created_by' => 1,
        ]);
        PaymentOption::create([
          'id'=> 5,
          'name'=> 'Zelle',
          'target_table' => 'zelle_payments',
          'created_by' => 1,
        ]);

        Commerce_payment_method::create([
          'id'=> 1,
          'commerce_id'=> 1,
          'payment_option_id'=> 3,
        ]);
    }
}
