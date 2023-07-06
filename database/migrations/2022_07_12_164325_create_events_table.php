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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('sub_title')->nullable();
            $table->dateTime('event_start_on')->nullable();
            $table->dateTime('event_ends_on')->nullable();
            $table->string('venue')->nullable();
            $table->text('image');
            $table->boolean('is_active')->default(1);
            $table->longText('description');

            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('hospital_id')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('hospital_id')->references('id')->on('hospital_profiles');
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
        Schema::dropIfExists('events');
    }
};
