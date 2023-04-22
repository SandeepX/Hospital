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
        Schema::create('doctor_page_title_settings', function (Blueprint $table) {
            $table->id();
            $table->string('intro')->nullable();
            $table->string('time')->nullable();
            $table->string('fix_appt')->nullable();
            $table->string('qualification')->nullable();
            $table->string('skill')->nullable();
            $table->string('experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_page_title_settings');
    }
};
