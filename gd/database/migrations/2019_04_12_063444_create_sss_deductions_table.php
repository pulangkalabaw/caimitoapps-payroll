<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSssDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('from');
            $table->float('to');
            $table->float('monthly_salary_credit');
            $table->float('social_security_er');
            $table->float('social_security_ee');
            $table->float('social_security_total');
            $table->float('ec_er');
            $table->float('total_contribution_er');
            $table->float('total_contribution_ee');
            $table->float('total_contribution_total');
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
        Schema::dropIfExists('sss_deductions');
    }
}
