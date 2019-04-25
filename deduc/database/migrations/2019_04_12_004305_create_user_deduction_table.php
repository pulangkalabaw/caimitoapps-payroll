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
        // * interest (undecided)
        // * deduction
        // * reason

		Schema::dropIfExists('user_deduction');
        Schema::create('user_deduction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('deduction_id');
            $table->string('name');
            $table->float('amount')->decimal('total_amount',2)->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->float('interest')->decimal('total_amount',2)->nullable();
            $table->float('deduction')->decimal('total_amount',2)->nullable();
            $table->text('reason')->nullable();
            $table->string('deduction_type')->nullable();
            $table->string('type')->nullable();
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
