<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('town_id')->unsigned();
            $table->string('weather_forecast');
            $table->datetime('date');
            $table->integer('ship_id')->unsigned();
            $table->integer('days_spent_in_the_sea');
            $table->integer('number_of_nets');
            $table->integer('location_id')->unsigned();
            $table->float('production_amount');
            $table->integer('fish_id_1');
            $table->integer('amount_fish_1')->unsigned();
            $table->integer('fish_id_2')->unsigned();
            $table->integer('amount_fish_2')->unsigned();
            $table->integer('fish_id_3')->unsigned();
            $table->integer('amount_fish_3')->unsigned();
            $table->text('note');
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
        Schema::drop('daily_operations');
    }
}
