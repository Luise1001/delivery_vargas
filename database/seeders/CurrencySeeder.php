<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'id'=> 1,
            'name'=> 'Dólares',
            'symbol' => 'USD',
            'tax' => 16
        ]);
        Currency::create([
            'id'=> 2,
            'name'=> 'Bolívares',
            'symbol' => 'Bs',
            'tax' => 16
        ]);
    }
}
