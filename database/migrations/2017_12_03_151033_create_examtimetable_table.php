<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamtimetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examtimetable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unticode')->nullable();
            $table->string('unitname')->nullable();
            $table->string('venue')->nullable();
            $table->string('day')->nullable();
            $table->date('time')->nullable();
            $table->string('category_id')->nullable();
            $table->string('batch_id')->nullable();
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
        Schema::drop('examtimetable');
    }
}
