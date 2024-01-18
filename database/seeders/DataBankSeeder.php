<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mobile_payment;

class DataBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mobile_payment::create([
            'id'=> 1,
            'commerce_id' => 1,
            'document_type' => 'G',
            'document' => '200168757',
            'phone' => '04129171033',
            'bank_id' => 1,
        ]);
    }
}
