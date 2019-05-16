<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFieldStripeUserAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stripe_user_account', function (Blueprint $table) {
            //
            $table->string('account')->nullable()->change()->comment('custom stripe account id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stripe_user_account', function (Blueprint $table) {
            //
        });
    }
}
