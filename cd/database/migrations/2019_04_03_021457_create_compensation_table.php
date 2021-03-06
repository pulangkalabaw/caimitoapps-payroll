<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompensationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::dropIfExists('compensation');
        Schema::create('compensation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('compensation_id');
            $table->string('name')->nullable();
            $table->float('amount')->nullable();
            $table->tinyInteger('taxable')->nullable();
            $table->string('type')->default('fixed'); //determines if fix or variable
            $table->string('code')->nullable();
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
        Schema::dropIfExists('compensation');
    }
}
