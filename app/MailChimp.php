<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailChimp extends Model
{
    //
    protected $fillable = ['user_id','email','name','user_type','status'];

    protected $table = 'mail_chimp_info';
}
