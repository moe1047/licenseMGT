<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\DailyOperation;
use App\Models\License;
use App\Models\Renewal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function dailyOperation(Request $request)
    {
        $fishes= Helper::fishesDropDown();
        $locations= Helper::locationDropDown();
        $towns= Helper::townsDropDown();
        $ships= Helper::shipsDropDown();

        if($request->has('search')){
            //$total_fish_1=0;
            $from=$request->from!=null?Carbon::createFromFormat('d/m/Y',$request->from)->toDateString():null;
            $to=$request->to!=null?Carbon::createFromFormat('d/m/Y',$request->to)->toDateString():null;
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
                });
                //->sum('amount_fish_2');
                //->get();
            $total_fishes=$operations->sum('amount_fish_1')+$operations->sum('amount_fish_2')+$operations->sum('amount_fish_3');
            //$total_fish_2=$operations->sum('amount_fish_2');
            //$total_fish_3=$operations->sum('amount_fish_3');
            $production_amount=$operations->sum('production_amount');
            $operations=$operations->orderBy('id','desc')->get();


            return view("reports.daily_operation",compact('fishes','locations','towns','ships','operations',
                'total_fishes','production_amount'));


        }

        return view("reports.daily_operation",compact('fishes','locations','towns','ships'));



    }

    public function license(Request $request)
    {

        $business_types= Helper::businessTypeDropDown();
        if($request->has('search')){
            //$request->all();
            //$total_fish_1=0;
            $from=$request->from!=null?Carbon::createFromFormat('d/m/Y',$request->from)->toDateString():null;
            $to=$request->to!=null?Carbon::createFromFormat('d/m/Y',$request->to)->toDateString():null;
             $licenses=License::when($request->has('from')&&$request->has('to'),
                function($builder) use ($request,$from,$to){
                    return $builder->whereBetween('date',array($from,$to));
                })
                ->when($request->has('serial'),function($builder) use ($request){
                    return $builder->where('serial',$request->input('serial'));
                })
                ->when($request->has('business_name'),function($builder) use ($request){
                    return $builder->where('business_name','like','%'.$request->input('business_name').'%');
                })
                ->when($request->has('establishment_year'),function($builder) use ($request){
                    return $builder->where('establishment_year',$request->input('establishment_year'));
                })
                ->when($request->has('operation_site'),function($builder) use ($request){
                    return $builder->where('operation_site',$request->input('operation_site'));
                })
                ->when($request->has('ownership'),function($builder) use ($request){
                    return $builder->where('ownership',$request->input('ownership'));
                })
                ->when($request->has('owner'),function($builder) use ($request){
                    return $builder->where('owner','like','%'.$request->input('owner').'%');
                })
                ->when($request->has('owner_tell'),function($builder) use ($request){
                    return $builder->where('owner','like','%'.$request->input('owner_tell_1').'%');
                })
                ->when($request->has('contact_person'),function($builder) use ($request){
                    return $builder->where('contact_person','like','%'.$request->input('contact_person').'%');
                })
                ->when($request->has('applicant_name'),function($builder) use ($request){
                    return $builder->where('applicant_name','like','%'.$request->input('applicant_name').'%');
                })
                ->when($request->has('business_types'),function($builder) use ($request){
                    return $builder->whereHas('businessTypes', function ($q) use ($request) {
                        $q->whereIn('id', $request->input('business_types'));
                    });
                });
            //->sum('amount_fish_2');
            //->get();
            $total_licenses=$licenses->get()->count();
            $licenses=$licenses->get();
            return view("reports.license",compact('business_types','total_licenses','licenses'));
        }
        return view("reports.license",compact('business_types'));
    }
    public function renewal(Request $request)
    {
        $licenses= Helper::licensesDropDown();
        if($request->has('search')){
            //$request->all();
            //$total_fish_1=0;

            //$from=$request->has('from')?Carbon::createFromFormat('d/m/Y',$request->from)->toDateString():Carbon::today()->toDateString();
            //$to=$request->has('to')?Carbon::createFromFormat('d/m/Y',$request->to)->toDateString():Carbon::today()->toDateString();
            $from=$request->from!=null?Carbon::createFromFormat('d/m/Y',$request->from)->toDateString():null;
            $to=$request->to!=null?Carbon::createFromFormat('d/m/Y',$request->to)->toDateString():null;
            //return Renewal::whereBetween('date',[$from,$to])->get();

            $query=Renewal::when($request->has('licenses'),function($builder) use ($request){
                    return $builder->whereIn('license_id',$request->input('licenses'));
                });
            if($request->input('status')=="expired")
            {
                 $query->whereBetween('expire_date',[$from,$to]);
            }
            if($request->input('status')=="renewed")
            {
                  $query->whereBetween('date',[$from,$to]);
            }
            //return $query->get();

                /*->when($request->has('status'),function($builder) use ($request){
                    return $builder->where('business_name','like','%'.$request->input('business_name').'%');
                })*/


            //->sum('amount_fish_2');
            //->get();
            $total_renewals=$query->get()->count();
             $renewals=$query->get();

            return view("reports.renewal",compact('licenses','renewals','total_renewals','from','to'));
        }

        return view("reports.renewal",compact('licenses'));



    }
    public function print_license(Request $request)
    {
        $renewals=Renewal::all();
        $total_renewals=$renewals->count();
        $licenses= Helper::licensesDropDown();
        if($request->has('search')){
            //$request->all();
            //$total_fish_1=0;

            //$from=$request->has('from')?Carbon::createFromFormat('d/m/Y',$request->from)->toDateString():Carbon::today()->toDateString();
            //$to=$request->has('to')?Carbon::createFromFormat('d/m/Y',$request->to)->toDateString():Carbon::today()->toDateString();
            $from=$request->from!=null?Carbon::createFromFormat('d/m/Y',$request->from)->toDateString():null;
            $to=$request->to!=null?Carbon::createFromFormat('d/m/Y',$request->to)->toDateString():null;
            //return Renewal::whereBetween('date',[$from,$to])->get();

            $query=Renewal::when($request->has('licenses'),function($builder) use ($request){
                return $builder->whereIn('license_id',$request->input('licenses'));
            });
            if($request->input('status')=="expired")
            {
                $query->whereBetween('expire_date',[$from,$to]);
            }
            if($request->input('status')=="renewed")
            {
                $query->whereBetween('date',[$from,$to]);
            }
            //return $query->get();

            /*->when($request->has('status'),function($builder) use ($request){
                return $builder->where('business_name','like','%'.$request->input('business_name').'%');
            })*/


            //->sum('amount_fish_2');
            //->get();
            $total_renewals=$query->get()->count();
            $renewals=$query->get();

            //return view("reports.renewal",compact('licenses','renewals','total_renewals','from','to'));
        }

        return view("reports.print_license",compact('licenses','renewals','total_renewals'));



    }
    public function show_print_license($id)
    {
        $renewal=Renewal::findOrFail($id);
        return view('reports.show_print_license',compact('renewal'));
    }
}
