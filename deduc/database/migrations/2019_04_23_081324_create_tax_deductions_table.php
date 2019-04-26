<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wage_type');
            $table->float('compensation_range_from');
            $table->string('compensation_range_to');
            $table->string('prescribed_withholding_tax');
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_deductions');
    }
}
