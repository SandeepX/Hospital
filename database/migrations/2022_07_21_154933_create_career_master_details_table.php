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
        Schema::create('career_master_details', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->bigInteger('career_designation_id')->unsigned();
            $table->date('job_opening_date');
            $table->date('job_closing_date');
            $table->string('position_type');
            $table->integer('openings');
            $table->text('image');
            $table->longText('description');
            $table->string('address');
            $table->double('salary_offered')->nullable();
            $table->boolean('status')->default(1);

            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('career_designation_id')->references('id')->on('career_designations');
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
        Schema::dropIfExists('career_master_details');
    }
};
