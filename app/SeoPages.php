<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoPages extends Model
{
    protected $fillable = ['id','page','title','keyword','description','sub_topic'];

    protected $table = "seo_pages";
}
