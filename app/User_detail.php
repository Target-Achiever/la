<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User_detail extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'surname','forename','date_of_birth','nationality','address_line_1',
        'address_line_2','country','country_code','state','city','post_code','zip','phone','business',
        'business_address','latitude','longitude','loginCount','lastLogin','location_string','social_login_response'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
}
