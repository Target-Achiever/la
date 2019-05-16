<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelled_appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('user_type',['end_user','non_prescriber','prescriber','super_admin'])->comment('1-end user,2-prescriber,3-noprescriber,4-super admin');
            $table->enum('appointment_type',[1,2])->comment('1-user appointment,2-nonprescriber appointment');
            $table->integer('appointment_id');
            $table->enum('status',[1,2,3])->comment('1-dedcted the amount form the payout,2-pending,3-cancelled by user');
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
        Schema::drop('cancelled_appointment');
    }
}
