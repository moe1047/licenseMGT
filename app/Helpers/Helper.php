<?php

namespace App\Helpers;


use App\Models\Fish;
use App\Models\Location;
use App\Models\Ship;
use App\Models\Town;

class Helper
{

    public static function fishesDropDown()
    {
        return Fish::all()->pluck('name','id');

    }
    public static function locationDropDown()
    {
        return Location::all()->pluck('name','id');

    }
    public static function townsDropDown()
    {
        return Town::all()->pluck('name','id');

    }
    public static function shipsDropDown()
    {
        return Ship::all()->pluck('shipOwner','id');

    }


}
