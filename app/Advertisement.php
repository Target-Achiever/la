<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','service','ad_banner','ad_header','ad_description','time_slot','days_slots',
                            'period_from','period_to','ad_status','ad_payment_status','amount','ad_offer','ad_offer_percentage'];

    protected $table = "advertisement";

    protected $dates = ['deleted_at'];
}
