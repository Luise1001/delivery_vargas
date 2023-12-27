<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::create([
          'id'=> 1,
          'day'=> 'Domingo'
        ]);
        Day::create([
          'id'=> 2,
          'day'=> 'Lunes'
        ]);
        Day::create([
          'id'=> 3,
          'day'=> 'Martes'
        ]);
        Day::create([
          'id'=> 4,
          'day'=> 'Miércoles'
        ]);
        Day::create([
          'id'=>5,
          'day'=> 'Jueves'
        ]);
        Day::create([
          'id'=> 6,
          'day'=> 'Viernes'
        ]);
        Day::create([
          'id'=> 7,
          'day'=> 'Sábado'
        ]);
    }
}
