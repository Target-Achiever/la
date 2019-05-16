<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider_refund_policy extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'provider_refund_policies';
	
    protected $fillable = [
        'user_id', 'refund', 'percentage_week','percentage_days','percentage_appointment_day'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
