<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderComboServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('provider_combo_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('services_id')->comment('combo services ids');
            $table->string('service_amount');
            $table->string('prescription_amount')->comment('prescription amount, it is for prescribers');
            $table->string('time_needed')->comment('time needed for surgery (in hrs)');
            $table->enum('service_status',[3,2,1])->comment('1-active,2-deactive,3-pending');
            $table->softDeletes();
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
        Schema::drop('provider_combo_services');
    }
}
