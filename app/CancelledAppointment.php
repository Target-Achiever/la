<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelledAppointment extends Model
{
    //
     protected $table = "cancelled_appointment";

    protected $fillable = ['user_id','user_type','appointment_type','appointment_id','status'];

}
