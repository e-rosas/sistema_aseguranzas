<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('discount_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('discount_id');
            $table->unsignedBigInteger('invoice_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status');
            $table->decimal('discounted_total', 13, 4);

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('discount_invoices');
    }
}
