<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\User;

class AppointmentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $provider = \Route::input('id'); //or $this->route('id');

        // return User::where('id', $provider);
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
            'user_contact' => 'required',
            // 'user_email'=>'required|email',
            'service_needed'=> 'required',
            'preferred_date'=>'required',
            'appointment_time_from' => 'required'

        ];
    }
    public function messages()
    {
        return [
            'user_contact.required'  => 'The contact number field is required.',
            'user_name.required'  => 'The name field is required.',
            'service_needed.required'  => 'The service field is required.',
            'preferred_date.required'  => 'The preferred date field is required.',
        ];
    }
}
