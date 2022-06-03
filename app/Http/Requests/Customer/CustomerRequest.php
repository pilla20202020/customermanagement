<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email|unique:customers|regex:/(.+)@(.+)\.(.+)/i',
            'mobile_no'=> 'required|string|max:13|min:10|unique:customers,mobile_no',
            'alternate_mobile_no'=> 'nullable|string|max:13|min:10',
            'father_name'=> 'nullable|string|',
            'mother_name'=> 'nullable|string|',
            'marital_status'=> 'nullable|string|',
            'province_id'=> 'required|integer|exists:provinces,id',
            'district_id'=> 'required|string|exists:districts,id',
            'municipality_id'=> 'required|string|exists:municipalities,id',
            'ward_no'=> 'required|integer',
            'village_name'=> 'nullable|string',
            'gender' => 'required|string|max:15',
            'nationality'=> 'required|string|',
            'citizenship'=> 'required|string|',
            'citizenship_issue_district_id'=> 'integer',
            'image' => 'nullable|image|mimes:jpg,jpeg',
            'citizenship_image' => 'nullable|image|mimes:jpg,jpeg',
        ];
    }
}
