<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldServicesSettingsPolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_settings', function (Blueprint $table) {
            $table->enum('service_location_preference',[1,2,3])->after('instant_appointment')->comment('1-provider location,2-mobile,3-flexible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_settings', function (Blueprint $table) {
            $table->dropColumn('service_location_preference');
        });
    }
}
