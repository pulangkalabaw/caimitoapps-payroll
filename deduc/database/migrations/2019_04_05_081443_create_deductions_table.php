<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Deductions
        // * deduction_id
        // * name
        // * taxable
        // * amount
        // * deduction
        // * code
        // * description
        
		Schema::dropIfExists('deductions');
        Schema::create('deductions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('deduction_id');
            $table->string('name');
			$table->string('taxable')->default(0);
            $table->float('amount')->decimal('total_amount',2)->nullable();
            $table->float('deduction')->decimal('total_amount',2)->nullable();
            $table->string('code')->nullable();
            $table->string('description')->nullable();
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('deductions');
    }
}
