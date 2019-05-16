<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaPaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('la_payment_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('paid to');
            $table->integer('paid_for_id')->comment('ex:appointment id,advertisement id');
            $table->enum('payment_type',[2,1,3])->comment('1- appointment, 2- advertisement','refund');
            $table->string('account')->comment('provider stripe account');
            $table->string('amount')->comment('paid amount');
            $table->string('la_share_percentage')->nullable()->comment('share for this transaction');
            $table->string('la_share_amount')->nullable()->comment('share for this transaction');
            $table->string('transaction_id')->comment('stripe transfer id');
            $table->dateTime('payment_date')->comment('payment done on');
            $table->enum('payment_status',[2,1])->comment('1-paid,2-failed');
            $table->text('description')->comment('any description for the payment');
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
        Schema::drop('la_payment_history');
    }
}
