<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Driver;
use App\Models\Commerce;
use App\Models\Product;


class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'test1',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 6
          ]);
        User::create([
            'username' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 6
          ]);
        User::create([
            'username' => 'test3',
            'email' => 'test3@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 6
          ]);
        User::create([
            'username' => 'test4',
            'email' => 'test4@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 5
          ]);
        User::create([
            'username' => 'test5',
            'email' => 'test5@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 5
          ]);
        User::create([
            'username' => 'test6',
            'email' => 'test6@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 5
          ]);
        User::create([
            'username' => 'test7',
            'email' => 'test7@gmail.com',
            'password' => Hash::make('papo'),
            'role_id' => 5
          ]);

    }
}
