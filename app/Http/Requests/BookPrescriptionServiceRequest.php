<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookPrescriptionServiceRequest extends Request
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
            'user_name' => 'required',
            'service_needed'=> 'required',
            'preferred_date'=>'required',
            'appointment_time_from' => 'required'

        ];
    }
    public function messages()
    {
        return [
            'service_needed.required'  => 'The service field is required',
        ];
    }
}
