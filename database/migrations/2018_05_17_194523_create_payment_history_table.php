<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('who done');
            $table->integer('paid_to')->comment('paid to user');
            $table->integer('paid_for_id')->comment('ex:appointment id,advertisement id');
            $table->integer('payment_type')->comment('1- appointment, 2- advertisement');
            $table->string('amount')->comment('paid amount');
            $table->string('transaction_id')->comment('stripe charge id');
            $table->dateTime('payment_date')->comment('payment done on');
            $table->integer('payment_status')->comment('1-paid,2-failed');
            $table->string('description')->comment('any description for the payment');
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
        Schema::drop('payment_history');
    }
}
