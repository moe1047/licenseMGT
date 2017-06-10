<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\DailyOperation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function indexDailyOperation(Request $request)
    {
        $fishes= Helper::fishesDropDown();
        $locations= Helper::locationDropDown();
        $towns= Helper::townsDropDown();
        $ships= Helper::shipsDropDown();

        if($request->has('search')){
            $from=$request->from;$to=$request->to;
            $operations=DailyOperation::when($request->has('from')&&$request->has('to'),
                function($builder) use ($request,$from,$to){
                    return $builder->whereBetween('date',array($from,$to));
                })
                ->when($request->has('towns'),function($builder) use ($request){
                    return $builder->whereIn('town_id',$request->input('towns'));
                })
                ->when($request->has('ships'),function($builder) use ($request){
                    return $builder->whereIn('ship_id',$request->input('ships'));
                })
                ->when($request->has('weather_forecasts'),function($builder) use ($request){
                    return $builder->whereIn('weather_forecast',$request->input('weather_forecasts'));
                })
                ->when($request->has('locations'),function($builder) use ($request){
                    return $builder->whereHas('locations', function ($q) use ($request) {
                        $q->whereIn('id', $request->input('locations'));
                    });
                })
                ->when($request->has('fishes'),function($builder) use ($request){
                    return $builder->whereIn('fish_id_1',$request->input('fishes'))
                        ->orWhereIn('fish_id_2',$request->input('fishes'))
                        ->orWhereIn('fish_id_3',$request->input('fishes'));
                })
                ->orderBy('id','desc')
                ->get();

            return view("reports.daily_operation",compact('fishes','locations','towns','ships','operations'));


        }else{
            return view("reports.daily_operation",compact('fishes','locations','towns','ships'));
        }


    }

}
