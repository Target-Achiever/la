<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{

    protected $fillable = ['professional_title','status'];

    protected $table = "professional";

}
