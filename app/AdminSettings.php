<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    //
    protected $fillable = ['header_text','home_banner','home_page','type','status'];

	protected $table = 'admin_settings';    
}
