<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@goudendraak.tk',
            'email_verified_at' => now(),
            'password' => \Hash::make('password')
        ]);

        $this->call(AllergySeeder::class);
        $this->call(DishRiceOptionSeeder::class);
    }
}
