<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCompDeducHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_comp_deduc_history', function (Blueprint $table) {
            // Common fields
            $table->increments('id');
            $table->string('batch_id');
            $table->string('user_id');
            $table->string('comp_deduc_id');
            $table->string('history_type')->nullable(); // deduc or comp
            $table->float('amount')->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            // Input for compensation
            $table->string('user_compensation_id');
            $table->boolean('taxable')->nullable();
            $table->string('type')->default('fixed'); // fixed or variable
            // Input for deduction
            $table->float('interest')->decimal('total_amount',2)->nullable();
            $table->float('deduction')->decimal('total_amount',2)->nullable();
            $table->string('remarks')->nullable();
            // Timestamps
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
        Schema::dropIfExists('user_comp_deduc_history');
    }
}
