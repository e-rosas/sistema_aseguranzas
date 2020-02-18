<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('item_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_service_id');
            $table->unsignedBigInteger('item_id');
            $table->string('description'); //add
            $table->decimal('price', 13, 4);
            $table->decimal('discounted_price', 13, 4);
            $table->integer('quantity')->default(1);

            $table->foreign('invoice_service_id')->references('id')->on('invoice_services')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('item_services');
    }
}