<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('uk')->nullable();
            $table->string('other_uk')->nullable();
            $table->string('uk_qualification')->nullable();
            $table->string('other_uk_qualification')->nullable();
            $table->string('professional')->nullable();
            $table->string('other_professional')->nullable();
            $table->string('registered_with')->nullable();
            $table->string('professional_pin')->nullable();
            $table->string('aesthetic_training')->nullable();
            $table->string('aesthetic_training_date')->nullable();
            $table->string('aesthetic_treatment')->nullable();
            $table->string('insurance_company_name')->nullable();
            $table->string('insurance_policy_number')->nullable();
            $table->string('prescribing_rights')->nullable();
            $table->string('other_aesthetic_training')->nullable();
            $table->string('other_prescribing_rights')->nullable();
            $table->string('identity')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('rights_prescribe')->nullable();
            $table->string('medical_qualification')->nullable();
            $table->string('aesthetic_training_certificate')->nullable();
            $table->string('insurance_certificate')->nullable();
            $table->string('other_certificate')->nullable();



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
        Schema::drop('user_answers');
    }
}
