<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Service;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Test;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(DaySeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(PaymentOptionSeeder::class);
        $this->call(TestSeeder::class);
    }
}
