<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('refund to');
            $table->integer('refund_action_id')->comment('ex:appointment id');
            $table->string('refund_id')->comment('stripe refund id');
            $table->string('paid_amount')->comment('provider service cost');
            $table->string('refund_amount')->comment('amount refunded');
            $table->string('la_part_recieved')->comment('la share in percentage');
            $table->string('provider_part_received')->comment('provider share in percentage');
            $table->enum('refund_status',[1,2])->comment('1-success,2-failed');
            $table->text('stripe_response')->comment('json data, stripe response');
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
        Schema::drop('refund_history');
    }
}
