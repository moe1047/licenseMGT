<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class DailyOperation extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'daily_operations';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
     protected $fillable = ['weather_forecast','town_id','date','ship_id','days_spent_in_the_sea','number_of_nets','location_id',
         'production_amount', 'fish_id_1','amount_fish_1','fish_id_2','amount_fish_2','fish_id_3','amount_fish_3','note'
         ,'number_of_other_gears','others_amount'];
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
    public function town()
    {
        return $this->belongsTo('App\Models\Town');
    }
    public function ship()
    {
        return $this->belongsTo('App\Models\Ship');
    }
    public function locations()
    {
        //return $this->belongsTo('App\Models\Location');
        //return $this->hasMany('App\Models\DailyOperationLocation');
        return $this->belongsToMany('App\Models\Location');
    }
    public function fish1()
    {
        return $this->belongsTo('App\Models\Fish','fish_id_1','id');
    }
    public function fish2()
    {
        return $this->belongsTo('App\Models\Fish','fish_id_2','id');
    }
    public function fish3()
    {
        return $this->belongsTo('App\Models\Fish','fish_id_3','id');
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
    */
    public function getShowDateAttribute($value)
    {
        return Carbon::parse($this->attributes['date'])->format('d-m-Y');
    }
}
