<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompensationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_compensation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_compensation_id');
            $table->string('user_id');
            $table->string('compensation_id');
            $table->float('amount')->nullable();
            $table->boolean('taxable')->nullable();
            $table->string('date_start');
            $table->string('type')->default('fixed'); //determines if fix or variable
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
        Schema::dropIfExists('user_compensation');
    }
}
