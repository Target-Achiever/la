<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInPaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_history', function (Blueprint $table) {
            //
            $table->text('stripe_response')->after('description')->comment('stripe response');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_history', function (Blueprint $table) {
            //
            $table->dropColumn('stripe_response');
        });
    }
}
