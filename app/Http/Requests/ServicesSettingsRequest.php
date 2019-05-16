<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServicesSettingsRequest extends Request
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
            'time_from' => 'required',
            'time_to' => 'required',
            'available_days' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'available_days.required'  => 'The available days field is required',
        ];
    }
}
