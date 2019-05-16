<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notifications', function(Blueprint $table){

            $table->increments('id');
            $table->integer('notify_action_id')->comment('ex:appointment id ');
            $table->integer('notify_action_type')->comment('1-appointment,2-prescription request');
            $table->integer('notify_action_from');
            $table->integer('notify_action_to');
            $table->string('notify_comment');
            $table->string('notify_message');
            $table->integer('notify_status')->comment('1-viewed, 2-not-viewed');
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
        //
        Schema::drop('notification');
    }
}
