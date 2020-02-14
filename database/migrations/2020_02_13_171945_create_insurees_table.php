<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsureesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('insurees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_data_id');
            $table->unsignedInteger('insurer_id');

            $table->foreign('person_data_id')->references('id')->on('person_data');
            $table->foreign('insurer_id')->references('id')->on('insurers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('insureds');
    }
}
