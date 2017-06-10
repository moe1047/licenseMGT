<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTypeLicensePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_type_license', function (Blueprint $table) {
            $table->integer('business_type_id')->unsigned()->index();
            $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');
            $table->integer('license_id')->unsigned()->index();
            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
            $table->primary(['business_type_id', 'license_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_type_license');
    }
}
