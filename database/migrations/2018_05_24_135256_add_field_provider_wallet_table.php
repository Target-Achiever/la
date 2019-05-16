<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldProviderWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_wallet', function (Blueprint $table) {
            //
            $table->float('amount_due')->default(0)->after('payment_history_id')->comment('amount will deduct from the next stripe payout/transfer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_wallet', function (Blueprint $table) {
            
            $table->dropColumn('amount_due');
        });
    }
}
