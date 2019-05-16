<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGainProviderTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gain_provider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header');
            $table->text('content');
            $table->string('gain_banner');
            $table->string('forward_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('gain_provider');
    }
}
