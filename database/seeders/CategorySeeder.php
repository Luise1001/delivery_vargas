<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'name'=> 'Restaurantes',
            'type'=> 'commerce',
        ]);
        Category::create([
            'id' => 2,
            'name'=> 'Licores',
            'type'=> 'commerce',
        ]);
        Category::create([
            'id' => 3,
            'name'=> 'Farmacias',
            'type'=> 'commerce',
        ]);
        Category::create([
            'id' => 4,
            'name'=> 'Supermercados',
            'type'=> 'commerce',
        ]);
        Category::create([
            'id' => 5,
            'name'=> 'Automotriz',
            'type'=> 'commerce',
        ]);
    }
}
