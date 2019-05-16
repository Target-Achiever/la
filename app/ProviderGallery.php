<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderGallery extends Model
{
    //

    protected $table = "provider_gallery";

    protected $fillable = [
        'user_id', 'file_name', 'extension','percentage_days','status'
    ];

}
