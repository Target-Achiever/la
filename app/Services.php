<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    protected $fillable = ['services_id','user_id','description','service_amount','time_needed',
                            'service_status','service_readmore','service_banner','service','service_type','combination','category','service_offer','offer_percentage','service_actual_amount'];
}
