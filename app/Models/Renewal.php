<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Renewal extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */


    //protected $table = 'renewals';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = ['license_id','note','expire_date','date'];
    // protected $hidden = [];
     protected $dates = ['date','expire_date'];


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
    public function license()
    {
        return $this->belongsTo('App\Models\License');
    }

    public function getShowDateAttribute($value)
    {
        return Carbon::parse($this->attributes['date'])->format('d-m-Y');
    }



    public function getExpireDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
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


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    public function setExpireDateAttribute($value)
    {
        return $this->attributes['expire_date']=null;
        //$this->attributes['date'] = strtolower($value);
    }
    */


}
