<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
  
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disease_detail_id')->nullable();
            $table->foreign('disease_detail_id')->references('id')->on('disease_details');
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('shape_id')->nullable();
            $table->foreign('shape_id')->references('id')->on('shapes');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedBigInteger('color_state_id')->nullable();
            $table->foreign('color_state_id')->references('id')->on('color_states');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('admins');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
