<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_gallery', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('provider id');
            $table->string('file_name');
            $table->string('extension');
            $table->enum('status',[0,1]);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_gallery', function (Blueprint $table) {
            //
            Schema::drop('provider_gallery');
        });
    }
}
