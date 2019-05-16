<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BookAppointment extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['user_id','provider_id','service_needed','user_name','user_contact','user_email','preferred_date','appointment_status','appointment_type','declined_by','created_at','appointment_time_from','appointment_time_to','service_amount','payment_status','payment_id','quantity','time_needed'];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $table = "appointment";

    protected $dates = ['deleted_at'];//for softdeletes
}
