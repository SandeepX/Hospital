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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patients_name');
            $table->double('contact_no');
            $table->string('email');
            $table->string('gender');
            $table->integer('age');
            $table->bigInteger('dept_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('appointment_time_id')->unsigned();
            $table->date('appointment_date');
            $table->string('note')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->default('pending');

            $table->bigInteger('hospital_id')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('appointment_time_id')->references('id')->on('doctor_schedule_time_details');
            $table->foreign('hospital_id')->references('id')->on('hospital_profiles');
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
        Schema::dropIfExists('appointments');
    }
};
