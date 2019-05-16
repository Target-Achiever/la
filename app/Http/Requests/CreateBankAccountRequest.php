<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBankAccountRequest extends Request
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
            'bank_name' => 'required',
            'account_number' => 'required|max:8|alpha_num',
            'sort_code' => 'required|max:6|alpha_num',
            'entity_type'=> 'required',
            'entity_dob_day'=> 'required|numeric|digits:2',
            'entity_dob_month'=> 'required|numeric|digits:2',
            'entity_dob_year'=> 'required|numeric|digits:4',
            // 'routing_number'=>'required',
            // 'entity_first_name'=> 'required',
            // 'entity_last_name'=> 'required',
            // 'country'=> 'required',
            // 'entity_state'=> 'required',
            // 'entity_city'=> 'required',
            // 'entity_postal_code'=> 'required'
        ];
    }
}
