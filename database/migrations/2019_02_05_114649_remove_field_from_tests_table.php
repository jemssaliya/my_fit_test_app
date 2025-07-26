<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldFromTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn([
                'hr_peak',
                'bp',
                'hr_rest',
                'weight',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->string('hr_peak')->nullable();
            $table->string('bp')->nullable();
            $table->string('hr_rest')->nullable();
            $table->double('weight')->nullable();
        });
    }
}
