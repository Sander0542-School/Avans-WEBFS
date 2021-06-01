<?php

namespace Database\Seeders;

use App\Models\Allergy;
use Illuminate\Database\Seeder;

class AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Allergy::create(['name' => 'Pork', 'icon' => 'fa-bacon']);
        Allergy::create(['name' => 'Lactose', 'icon' => 'fa-egg']);
        Allergy::create(['name' => 'Gluten', 'icon' => 'fa-seeding']);
    }
}
