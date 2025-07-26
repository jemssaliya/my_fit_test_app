<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('hr_peak')->nullable();
            $table->string('bp')->nullable();
            $table->string('hr_rest')->nullable();
            $table->integer('age')->nullable();
            $table->double('weight')->nullable();
            $table->integer('test_type')->unsigned();
            $table->timestamps();
        });
    }

    // Note : if requirement changed to dynamic parameters, this table should change

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
