<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dishes', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('dish_id')->constrained('dishes', 'id');
            $table->foreignId('order_id')->constrained('orders', 'id');
            $table->smallInteger('amount')->default(1);
            $table->decimal('unit_price', 5, 2);
            $table->tinyInteger('btw')->default(9);
            $table->string('remark')->nullable();

            $table->foreignId('rice_option_id')->nullable()->constrained('dish_rice_options', 'id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_dishes');
    }
}
