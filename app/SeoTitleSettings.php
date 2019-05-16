<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoTitleSettings extends Model
{
    protected $fillable = ['id','site_name','title_separator'];

    protected $table = "seo_title_settings";
}
