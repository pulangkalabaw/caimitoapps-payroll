<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PayrollMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_code');
            $table->string('basic_salary');
            $table->string('compensation');
            $table->string('deduction');
            $table->string('government_deduction');
            $table->string('lates');
            $table->string('undertime');
            $table->string('overtime');
            $table->string('tax');
            $table->string('absences');
            $table->string('run_date');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
