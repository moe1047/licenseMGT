<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DailyOperationRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'town_id'=>'required',
            'weather_forecast'=>'required',
            'date'=>'required','ship_id'=>'required',
            'days_spent_in_the_sea'=>'required',
            'number_of_nets'=>'required',
            'locations'=>'required',
            'production_amount'=>'required',
            'fish_id_1'=>'required',
            'amount_fish_1'=>'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
