<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider_policy extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'provider_policies';
	
    protected $fillable = [
        'user_id', 'cancellation_policy','rescheduling_policy','dissatisfaction_policy'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
