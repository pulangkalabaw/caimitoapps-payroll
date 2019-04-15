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
            $table->string('from');
            $table->string('to');
            $table->string('monthly_salary_credit');
            $table->string('social_security_er');
            $table->string('social_security_ee');
            $table->string('social_security_total');
            $table->string('ec_er');
            $table->string('total_contribution_er');
            $table->string('total_contribution_ee');
            $table->string('total_contribution_total');
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
