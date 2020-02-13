<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_data_id');
            $table->unsignedBigInteger('insured_id');

            $table->foreign('person_data_id')->references('id')->on('person_data');
            $table->foreign('insured_id')->references('id')->on('insureds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
