<?php

namespace Database\Seeders;

use App\Models\Allergy;
use App\Models\DishRiceOption;
use Illuminate\Database\Seeder;

class DishRiceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishRiceOption::create(['name' => 'Witte rijst']);
        DishRiceOption::create(['name' => 'Nasi/bami goreng']);
        DishRiceOption::create(['name' => 'Mihoen goreng']);
        DishRiceOption::create(['name' => 'Chinese bami']);
    }
}
