<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDailyOperationsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_operations', function (Blueprint $table) {
            $table->integer('fish_id_2')->unsigned()->nullable()->change();
            $table->integer('amount_fish_2')->unsigned()->nullable()->change();
            $table->integer('fish_id_3')->unsigned()->nullable()->change();
            $table->integer('amount_fish_3')->unsigned()->nullable()->change();
            $table->text('note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *'date'=> 'required'
    ,'business_name'=> 'required',
    'establishment_year'=> 'required',
    'operation_site'=> 'required',
    'ownership'=> 'required',
    'owner'=> 'required',
    'owner_tell_1'=> 'required',
    'owner_tell_2',
    'owner_email',
    'contact_person'=> 'required',
    'contact_person_tell_1'=> 'required'
    ,'contact_person_tell_2',
    'contact_person_email',
    'operation_status'=> 'required',
    'assets',
    'applicant_name'=> 'required',
    'applicant_tell_1'=> 'required',
    'applicant_tell_2',
    'applicant_tell_3',
    'application_email',
    'permenant_address',
    'business_charter',
    'attorny_general_registration_letter',
    'bank_guarantee',
    'ownership_document',
    'note'
     * @return void
     */
    public function down()
    {
        //
    }
}
