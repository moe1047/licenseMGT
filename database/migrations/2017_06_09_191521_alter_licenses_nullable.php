<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLicensesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->string('owner_tell_1')->nullable()->change();
            $table->string('owner_tell_2')->nullable()->change();
            $table->string('owner_email')->nullable()->change();

            $table->string('contact_person_tell_1')->nullable()->change();
            $table->string('contact_person_tell_2')->nullable()->change();
            $table->string('contact_person_email')->nullable()->change();

            $table->text('assets')->nullable()->change();

            $table->string('applicant_tell_1')->nullable()->change();
            $table->string('applicant_tell_2')->nullable()->change();
            $table->string('applicant_tell_3')->nullable()->change();
            $table->string('application_email')->nullable()->change();
            $table->string('permenant_address')->nullable()->change();
            $table->string('business_charter')->nullable()->change();
            $table->string('attorny_general_registration_letter')->nullable()->change();
            $table->string('bank_guarantee')->nullable()->change();
            $table->boolean('ownership_document')->nullable()->change();
            $table->text('note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
