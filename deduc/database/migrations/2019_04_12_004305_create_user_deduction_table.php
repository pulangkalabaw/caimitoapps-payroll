<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDeductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // User Deduction
        // * user_id
        // * deduction_id
        // * name
        // * amount
        // * date_start
        // * date_end
        // * interest (optional)
        // * deduction
        // * type (Goverment, Company, Other deduction)

        // check first if goverment type is applied
        // * tax_type (at (after tax) or bt (before tax))
        // * remarks

		Schema::dropIfExists('user_deduction');
        Schema::create('user_deduction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('deduction_id');
            $table->string('name');
            $table->float('amount')->decimal('total_amount',2)->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();

            // optional
            $table->float('interest')->decimal('total_amount',2)->nullable();
            $table->float('deduction')->decimal('total_amount',2)->nullable();
            $table->string('type')->nullable(); //Goverment or Company or other deduction
            // if the type is Goverment apply tax type
            $table->string('tax_type')->nullable(); // at(after tax) or bt(before tax)
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('user_deduction');
    }
}
