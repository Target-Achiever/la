<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('end user id');
            $table->integer('provider_id')->comment('provider id');
            $table->integer('service_needed')->comment('service id');
            $table->string('service_amount')->comment('service amount when appointment requested');
            $table->string('user_name');
            $table->string('user_contact');
            $table->string('user_email');
            $table->date('preferred_date');
            $table->string('appointment_time_from')->comment('ex: 11:00 - 13:00');
            $table->string('appointment_time_to')->comment('ex: 11:00 - 13:00');
            $table->enum('appointment_status',[1,2,3,4,5])->comment('1-request,2-accepted,3-declined by provider,4-cancelled by user,5-cancelled by provider');
            $table->enum('appointment_type',[1,2])->comment('1-(user to provider ), 2-(non-prescriber to prescriber)');
            $table->enum('payment_status',[2,1])->comment('1-paid,2-appointment request sent status');
            $table->integer('payment_id')->comment('payment history id');
            $table->integer('declined_by')->comment('by provider or user');
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
        Schema::drop('apponitment');
    }
}
