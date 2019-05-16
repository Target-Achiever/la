<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    //
    protected $table = 'payment_history';

    protected $fillable = ['user_id','paid_to','paid_for_id','payment_type','amount','transaction_id','payment_date','payment_status','description','la_share_amount','la_share_percentage'];
}
