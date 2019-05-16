<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoWeb extends Model
{
    protected $fillable = ['id','web_master','verification_code'];

    protected $table = "seo_web";
}
