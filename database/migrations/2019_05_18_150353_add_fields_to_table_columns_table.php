<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTableColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color_code')->nullable();
            $table->string('display')->nullable();
            $table->integer('sq')->nullable(); //sequence 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_columns', function (Blueprint $table) {
            $table->dropColumn([
                'id',
                'color_code',
                'display',
                'sq',
            ]);
        });
    }
}
