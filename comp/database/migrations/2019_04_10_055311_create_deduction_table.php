<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deduction_id');
            $table->string('name')->nullable();
            $table->float('amount')->decimal('total_amount',2)->nullable();
            $table->float('interest')->decimal('total_amount',2)->nullable();
            $table->float('deduction')->decimal('total_amount',2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deduction');
    }
}
