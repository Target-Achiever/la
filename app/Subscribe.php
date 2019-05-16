<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['subscribe_email'];

    protected $table = "subscribe";

}
