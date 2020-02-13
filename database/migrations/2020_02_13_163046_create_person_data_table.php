<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDataTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('person_data', function (Blueprint $table) {
            $table->Bigincrements('id');
            $table->string('last_name');
            $table->string('maiden_name');
            $table->string('name');
            $table->date('birth_date');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('postal_code');
            $table->string('phone_number');
            $table->string('email');
            $table->boolean('insured');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('person_data');
    }
}
