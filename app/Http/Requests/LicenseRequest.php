<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LicenseRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
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

            'date'=> 'required'
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
