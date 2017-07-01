<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class License extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'licenses';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = ['id','date','business_name','establishment_year','operation_site','ownership','owner','owner_tell_1',
     'owner_tell_2','owner_email','contact_person','contact_person_tell_1','contact_person_tell_2','contact_person_email','operation_status','assets','applicant_name','applicant_tell_1','applicant_tell_2',
'applicant_tell_3','application_email','permenant_address','business_charter','attorny_general_registration_letter','bank_guarantee',
'ownership_document','note','serial'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function businessTypes()
    {
        //return $this->belongsTo('App\Models\Location');
        //return $this->hasMany('App\Models\DailyOperationLocation');
        return $this->belongsToMany('App\Models\BusinessType');
    }

    public function renewals()
    {
        //return $this->belongsTo('App\Models\Location');
        return $this->hasMany('App\Models\Renewal');
        //return $this->belongsToMany('App\Models\BusinessType');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getLicenseOwnerAttribute(){
        return $this->serial." - ".$this->business_name;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
