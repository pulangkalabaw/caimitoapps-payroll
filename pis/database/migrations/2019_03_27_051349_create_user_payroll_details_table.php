<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPayrollDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payroll_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->unique();

            // Payroll details
            $table->float('basic_salary', 20, 2)->default(0);
            $table->integer('allowances')->nullable();
            $table->integer('loans')->nullable();
            $table->string('wage_type')->default('daily');
            $table->string('bank_details')->nullable();
            $table->string('payout_type')->default('cash');


            // Government UserDetails
            $table->string('tax_computation')->default('none');
            $table->string('tin_number')->nullable();
            $table->string('sss_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('hdmf_number')->nullable();

            // $table->timestamps();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payroll_details');
    }
}
