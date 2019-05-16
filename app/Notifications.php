<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    //
    protected $fillable = ['notify_action_id','notify_action_type','notify_comment','notify_message','notify_status','notify_action_from','notify_action_to','created_at','updated_at'];
}
