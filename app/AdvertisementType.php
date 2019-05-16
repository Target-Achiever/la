<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementType extends Model
{

    protected $fillable = ['ad_days','ad_weeks'];

    protected $table = "advertisement_type";


}
