<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_data_id');
            $table->string('number')->unique();
            $table->date('date');
            $table->text('comments');
            $table->string('state');
            $table->decimal('total', 13, 4);
            $table->decimal('total_with_discounts', 13, 4);
            $table->decimal('amount_paid', 13, 4);
            $table->foreign('person_data_id')->references('id')->on('person_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
