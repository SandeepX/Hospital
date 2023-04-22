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
        Schema::create('doctor_schedule_time_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_schedule_id')->unsigned();
            $table->time('time_from');
            $table->time('time_to');

            $table->foreign('doctor_schedule_id')->references('id')->on('doctor_schedules');

            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_schedule_time_details');
    }
};
