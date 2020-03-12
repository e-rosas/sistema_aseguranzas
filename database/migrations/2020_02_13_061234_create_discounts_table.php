<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /* Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('percentage', 5, 2);
            $table->string('range_of_days');
            $table->integer('amount_of_days');
            $table->timestamps();
            $table->softDeletes();
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
