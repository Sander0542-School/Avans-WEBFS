<?php

use App\Models\Allergy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->timestamps();
        });

        Allergy::create(['name' => 'Pork', 'icon' => 'fa-bacon']);
        Allergy::create(['name' => 'Lactose', 'icon' => 'fa-egg']);
        Allergy::create(['name' => 'Gluten', 'icon' => 'fa-seeding']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allergies');
    }
}
