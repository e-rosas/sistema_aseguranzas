<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuredsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('insureds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_data_id');
            $table->unsignedInteger('insurance_id');

            $table->foreign('person_data_id')->references('id')->on('person_data');
            $table->foreign('insurance_id')->references('id')->on('insurances');
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
