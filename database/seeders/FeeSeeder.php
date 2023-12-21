<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fee;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Fee::create([
           'id'=> 1,
           'from' => 0,
           'to' => 3,
           'service_id'=> 1,
           'price' => 1,
           'special' => false,
           'created_by' => 1
         ]);
         Fee::create([
           'id'=> 2,
           'from' => 3.1,
           'to' => 6,
           'service_id'=> 1,
           'price' => 2,
           'special' => false,
           'created_by' => 1
         ]);
         Fee::create([
           'id'=> 3,
           'from' => 6.1,
           'to' => 1000,
           'service_id'=> 1,
           'price' => 0.25,
           'special' => true,
           'created_by' => 1
         ]);
    }
}
