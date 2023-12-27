<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 
          'id'=> 1,
          'name' => 'dev',
          'display_name'=> 'Developer',
          'level' => 1,
          'service_id' => 1
        ]);
        Role::create([ 
          'id'=> 2,
          'name' => 'admin',
          'display_name'=> 'Administrador',
          'level' => 2,
          'service_id' => 1
        ]);
        Role::create([ 
          'id'=> 3,
          'name' => 'manager',
          'display_name'=> 'Supervisor',
          'level' => 3,
          'service_id' => 1
        ]);
        Role::create([ 
          'id'=> 4,
          'name' => 'driver',
          'display_name'=> 'Conductor',
          'level' => 4,
          'service_id' => 1
        ]);
        Role::create([ 
          'id'=> 5,
          'name' => 'commerce',
          'display_name'=> 'Comercio',
          'level' => 5,
          'service_id' => 1
        ]);
        Role::create([ 
          'id'=> 6,
          'name' => 'user',
          'display_name'=> 'usuario',
          'level' => 6,
          'service_id' => 1
        ]);
    }
}
