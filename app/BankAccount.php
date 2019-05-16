<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    //
    protected $table = 'bank_account';

    protected $fillable = ['user_id','account_info','account_id','stripe_response','status'];
}
