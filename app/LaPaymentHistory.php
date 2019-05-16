<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaPaymentHistory extends Model
{
    //
    protected $table="la_payment_history";

    protected $fillable = ['user_id','paid_for_id','payment_type','amount','la_share_percentage','la_share_amount','transaction_id','payment_date','payment_status','description','created_at','updated_at'];
}
