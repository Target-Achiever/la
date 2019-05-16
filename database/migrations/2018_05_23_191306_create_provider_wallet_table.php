<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('provider id');
            $table->string('amount_credited')->comment('amount credited to provider wallet');
            $table->string('amount_debited')->comment('amount debited from provider wallet');
            $table->string('balance')->comment('balance');
            $table->enum('type',[1,2])->comment('1-credited,2-debited');
            $table->integer('payment_history_id')->comment('payment_history_id');
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
        Schema::drop('provider_wallet');
    }
}
