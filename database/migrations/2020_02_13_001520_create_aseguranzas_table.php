<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAseguranzasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('aseguranzas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('domicilio');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('codigo_postal');
            $table->string('telefono');
            $table->string('correo_e');
            $table->string('clave');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('aseguranzas');
    }
}
