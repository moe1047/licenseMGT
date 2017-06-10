<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyOperationLocationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_operation_location', function (Blueprint $table) {
            $table->integer('daily_operation_id')->unsigned()->index();
            //$table->foreign('daily_operation_id')->references('id')->on('daily_operations')->onDelete('cascade');
            $table->integer('location_id')->unsigned()->index();
            //$table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            //$table->primary(['daily_operation_id', 'location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('daily_operation_location');
    }
}
