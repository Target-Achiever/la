<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationCount extends Model
{

    protected $fillable = ['user_id','count'];

    protected $table = "user_registration_count";
}
