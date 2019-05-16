<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
			
            $table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->enum('title', ['Mr','Mrs','Miss','Ms','Dr']);
            $table->string('surname')->nullable();
            $table->string('forename')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('business')->nullable();
            $table->string('business_address')->nullable();
			$table->string('latitude');
			$table->string('longitude');
			$table->integer('loginCount')->comment('number of times logged in');
            $table->dateTime('lastLogin')->comment('when the user last logged in');
            $table->rememberToken();
            $table->timestamps();
			
            $table->softDeletes();
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
        Schema::drop('user_details');
    }
}
