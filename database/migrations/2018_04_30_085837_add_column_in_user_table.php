<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string("verification_code")->after('remember_token')->comment('mail verification code');
            $table->dateTime("verified_at")->nullable()->after('verification_code')->comment('mail verification done at');
            $table->dateTime("verification_code_sent_at")->after('verified_at')->comment('mail verification code sent date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
