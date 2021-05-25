<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishAllergyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_allergy', function (Blueprint $table) {
            $table->foreignId('dish_id')->constrained('dishes', 'id');
            $table->foreignId('allergy_id')->constrained('allergies', 'id');

            $table->primary(['dish_id', 'allergy_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_allergy');
    }
}
