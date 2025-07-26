<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('heading');
            $table->text('sub_heading')->nullable();
            $table->text('description')->nullable();
            $table->string('data_type')->nullable();
            $table->timestamps();
            /* $table->unique(
                ['name','column_heading','column_sub_heading'],
                'columns_unique_index'
			); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collumns');
    }
}
