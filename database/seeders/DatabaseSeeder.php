<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // CountrySeeder::class ,
            // ShippingStatuesSeeder::class ,
            // PaymentMethodsSeeder::class
            // ExpensesCategorySeeder::class ,
            SettingsSeeder::class ,
            AdminSeeder::class ,
        ]);
    }
}
