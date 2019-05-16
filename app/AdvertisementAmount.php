<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementAmount extends Model
{

    protected $fillable = ['ad_amount','ad_type'];

    protected $table = "advertisement_amount";

}
