<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commerce;

class CommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commerce::create([
            'id' => 1,
            'user_id' => 2,
            'name' => 'Delivery Vargas, S.A',
            'document_type' => 'G',
            'document' => '200168757',
            'phone' => '04129171033'
        ]);
    }
}
