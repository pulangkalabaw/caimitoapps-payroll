<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_name');
            $table->float('amount');
            $table->float('interest_rate');
            $table->string('loan_term');
            $table->float('monthly_amortization');
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
        Schema::dropIfExists('loan_deductions');
    }
}
