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
        Schema::create('static_page_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned();
            $table->string('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->longText('description');
            $table->text('image')->nullable();
            $table->boolean('is_active')->default(1);

            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('hospital_id')->unsigned();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('page_id')->references('id')->on('pages');
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
        Schema::dropIfExists('static_page_details');
    }
};
