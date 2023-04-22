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
        Schema::create('hospital_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('logo');
            $table->string('phone_one');
            $table->string('phone_two')->nullable();
            $table->longText('description');
            $table->longText('marquee_content');
            $table->text('facebook_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->text('twitter_link')->nullable();
            $table->text('website_url')->nullable();
            $table->double('location_lat')->nullable();
            $table->double('location_long')->nullable();

            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();


            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('hospital_profiles');
    }
};
