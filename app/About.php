<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{

    protected $fillable = ['about_header','about_content','about_banner','about_status','about_readmore'];

    protected $table = "about";

}
