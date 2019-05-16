<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('created by');
            $table->integer('service')->comment('advertisement for service');
            $table->string('ad_banner')->comment('banner name,path');
            $table->string('ad_header')->comment('banner header txt');
            $table->string('ad_description')->comment('banner description');
            $table->dateTime('period_from')->comment('ad show from');
            $table->dateTime('period_to')->comment('ad show from');
            $table->enum('ad_status',[2,1,3])->comment('1-active,2-pending,3-removed');
            $table->enum('ad_payment_status',[2,1])->comment('1-payment success,2-not yet done');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('advertisement');
    }
}
