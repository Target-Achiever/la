<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('provider_services',function(Blueprint $table)
        {   
            $table->increments('provider_services_id');
            $table->integer('user_id');
            $table->unsignedInteger('services_id');
            $table->string('service_amount');
            $table->string('prescription_amount')->comment('prescription amount, it is for prescribers');
            $table->string('time_needed')->comment('time needed for surgery (in hrs)');
            $table->integer('service_status');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('services_id')->references('services_id')->on('services');

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
        Schema::drop('users');
    }
}
