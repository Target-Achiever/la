<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusMail extends Model
{
    //
    protected $fillable = ['status_template','status_type','user_id'];

    protected $table = "status_mail";
}
