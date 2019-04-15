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
            $table->float('basic_salary');
            $table->float('gross_income');
            $table->float('compensation');
            $table->float('deductions');
            $table->float('sss_deduction');
            $table->float('pagibig_deduction');
            $table->float('philhealth_deduction');
            $table->float('total_government_deduction');
            $table->float('lates');
            $table->float('undertime');
            $table->float('absences');
            $table->float('overtime');
            $table->float('tax');
            $table->float('taxable');
            $table->float('non_taxable');
            $table->float('total');
            $table->string('run_date');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
