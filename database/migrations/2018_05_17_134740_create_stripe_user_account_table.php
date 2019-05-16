<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeUserAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_user_account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('user id');
            $table->string('account')->comment('custom stripe account id');
            $table->string('secret_key')->comment('account secret key');
            $table->string('publishable_key')->comment('account publishable key');
            $table->integer('ac_created_at')->comment('account created date');
            $table->text('stripe_response')->comment('response from stripe');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('stripe_user_account');
    }
}
