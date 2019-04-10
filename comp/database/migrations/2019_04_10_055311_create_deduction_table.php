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
            $table->float('total_amount')->decimal('total_amount',2)->nullable();
            $table->string('timeframe')->nullable();
            $table->float('interest')->nullable();
            $table->float('deduction')->nullable();
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
