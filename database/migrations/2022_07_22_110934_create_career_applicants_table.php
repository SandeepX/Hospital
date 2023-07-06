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
        Schema::create('career_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->bigInteger('career_master_id')->unsigned();
            $table->string('email');
            $table->string('contact_no');
            $table->text('cv')->nullable();
            $table->text('cover_letter')->nullable();
            $table->longText('note');
            $table->double('expected_salary')->nullable();
            $table->foreign('career_master_id')->references('id')->on('career_master_details');
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
        Schema::dropIfExists('career_applicants');
    }
};
