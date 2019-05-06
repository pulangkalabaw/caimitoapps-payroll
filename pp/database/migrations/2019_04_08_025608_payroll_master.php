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

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');

            // Basic Pay
            $table->string('basic_pay_type');
            $table->float('basic_pay');

            // Compensations
            $table->float('taxable_compensation');
            $table->float('nontaxable_compensation');
            $table->float('total_compensation');
            $table->text('compensation_data');

            // Deductions
            $table->float('other_deductions');
            $table->float('government_loans');
            $table->float('total_deductions');
            $table->text('deduction_data');

            // Government Deductions
            $table->float('sss_deduction');
            $table->float('pagibig_deduction');
            $table->float('philhealth_deduction');
            $table->float('total_government_deduction');

            // Timekeeping
            $table->float('lates');
            $table->float('undertime');
            $table->float('absences');
            $table->float('overtime');
            $table->text('overtime_data');
            $table->text('leaves');

            // Taxes
            $table->float('taxable_income');
            $table->float('withholding_tax');

            // Net Pay
            $table->float('gross_income');
            $table->float('net_pay');

            // Other Informations
            $table->text('payroll_details');
            $table->text('other_info');
            $table->date('run_date');

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
