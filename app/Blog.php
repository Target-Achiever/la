<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['blog_header','blog_content','blog_banner','blog_status'];

    protected $table = "blog";
}
