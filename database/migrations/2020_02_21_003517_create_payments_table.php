<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_data_id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('number');
            $table->text('comments')->nullable();
            $table->dateTime('date');
            $table->date('date_service')->nullable();
            $table->decimal('amount', 13, 4);
            $table->foreign('person_data_id')->references('id')->on('person_data')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
