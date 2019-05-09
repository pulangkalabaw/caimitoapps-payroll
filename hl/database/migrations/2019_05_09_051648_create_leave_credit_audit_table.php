<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveCreditAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Schema::dropIfExists('leave_credit_audit');

        Schema::create('leave_credit_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('employee_code');
            $table->string('leave_id');
            $table->float('credits');
            $table->string('update_type');
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('leave_credit_audit');
    }
}
