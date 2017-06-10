<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date');
            $table->string('serial')->nullable();
            $table->string('business_name');
            $table->smallInteger('establishment_year');
            $table->string('operation_site');
            $table->string('ownership');
            $table->string('owner');
            $table->string('owner_tell_1');
            $table->string('owner_tell_2');
            $table->string('owner_email');
            $table->string('contact_person');
            $table->string('contact_person_tell_1');
            $table->string('contact_person_tell_2');
            $table->string('contact_person_email');
            $table->string('operation_status');
            $table->text('assets');
            $table->string('applicant_name');
            $table->string('applicant_tell_1');
            $table->string('applicant_tell_2');
            $table->string('applicant_tell_3');
            $table->string('application_email');
            $table->string('permenant_address');
            $table->string('business_charter');
            $table->string('attorny_general_registration_letter');
            $table->string('bank_guarantee');
            $table->boolean('ownership_document');
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
        Schema::drop('licenses');
    }
}
