<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('menu_categories', 'id');
            $table->string('number', 4);
            $table->string('addition', 4)->nullable();
            $table->string('name');
            $table->text('description');
            $table->decimal('price',5,2);
            $table->tinyInteger('btw')->default(9);
            $table->tinyInteger('spiciness_level')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['number', 'addition']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
