<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Settings;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::destroy(1);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'type' => User::ADMIN,
            'password' => Hash::make('123456789'),
        ]);
    }
}
