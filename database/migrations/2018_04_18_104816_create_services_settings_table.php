<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_settings',function(Blueprint $table){

            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->string('time_from')->comment('consultation time from');
            $table->string('time_to')->comment('consultation time to');
            $table->string('available_days')->comment('consultation days');
            $table->enum('service_enable',[1,2])->comment('1-enabled, 2-disabled');
            $table->enum('prescription_enable',[1,2])->comment('1-enabled, 2-disabled');
            $table->enum('status',[1,2])->comment('1-active, 2-not-active');
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
        //
    }
}
