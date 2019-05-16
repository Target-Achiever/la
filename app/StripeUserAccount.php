<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeUserAccount extends Model
{
    //
    protected $table = 'stripe_user_account';

    protected $fillable = ['user_id','account','secret_key','publishable_key','ac_created_at','stripe_response'];
}
