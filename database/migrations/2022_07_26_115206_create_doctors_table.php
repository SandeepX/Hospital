<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {

            $table->id();
            $table->string('full_name');
            $table->date('dob')->nullable();
            $table->string('email')->nullable()->unique();
            $table->mediumText('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->bigInteger('dept_id')->unsigned();
            $table->string('speciality')->nullable();
            $table->longText('bio')->nullable();
            $table->float('experience_in_year')->nullable();
            $table->integer('appointment_limit')->nullable();
            $table->boolean('is_active')->default(1);
            $table->text('fb_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->text('twitter_link')->nullable();

            $table->bigInteger('hospital_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('hospital_id')->references('id')->on('hospital_profiles');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('updated_by')->references('id')->on('users');

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
        Schema::dropIfExists('doctors');
    }
};
