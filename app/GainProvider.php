<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GainProvider extends Model
{
    protected $fillable = ['header','content','gain_banner','forward_link'];

    protected $table = "gain_provider";
}
