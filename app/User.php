<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verification_code','verified_at',
        'verification_code_sent_at','photo','administrator_approval','user_slug','deleted_at','social_login_type','social_login_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
	public function getUserDetails()
    {
        return $this->hasOne('App\User_detail','user_id','id');
    }
	public function getUserAnswers()
    {
        return $this->hasMany('App\User_answer','user_id','id');
    }
	public function getProviderPolicies()
    {
        return $this->hasOne('App\Provider_policy','user_id','id');
    }
    public function getProviderServices()
    {

        return $this->hasMany('App\ProviderServices','user_id','id');
    }
}
