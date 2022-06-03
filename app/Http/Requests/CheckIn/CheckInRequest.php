<?php

namespace App\Http\Requests\CheckIn;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
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
            'customer_id'=> 'required|string|exists:customers,id',
            'checked_in' => 'required|date|',
            'room_id' => 'required|string|',
            'room_no' => 'required|string|',
            'total_no_people' => 'required|string|',
            'total_no_rooms' => 'required|string|',
            'expected_days' => 'nullable|string|',
            'initial_payment' => 'nullable|string|',
        ];
    }
}
