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
          'username' => 'Luis',
          'email' => 'luissalazar936@gmail.com',
          'password' => Hash::make('luis10'),
          'role_id' => 1
        ]);
    }
}
