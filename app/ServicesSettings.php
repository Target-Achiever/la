<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesSettings extends Model
{
    //
    protected $table = "services_settings";

    protected $fillable = ['user_id,time_from','time_to','available_days','status','instant_appointment','service_location_preference'];
}
