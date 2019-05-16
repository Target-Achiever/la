<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailChimpInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_chimp_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('registered user');
            $table->string('email')->comment('registered user email');
            $table->string('name')->comment('registered user name');
            $table->enum('user_type',[1,2])->comment('1-end_user,2-provider');
            $table->enum('status',[1,2])->comment('1-active,2-not active');
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
        Schema::drop('mail_chimp_info');
    }
}
