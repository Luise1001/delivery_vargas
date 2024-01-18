<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'id' => 1,
          'username' => 'Luis',
          'email' => 'luissalazar936@gmail.com',
          'password' => Hash::make('luis10'),
          'role_id' => 1
        ]);

        User::create([
          'id' => 2,
          'username' => 'Xavier',
          'email' => 'xavier@deliveryvargaslg.com',
          'password' => Hash::make('xavier10'),
          'role_id' => 2
        ]);

        User::create([
          'id' => 3,
          'username' => 'Anais',
          'email' => 'anais@deliveryvargaslg.com',
          'password' => Hash::make('anais10'),
          'role_id' => 2
        ]);
    }
}
