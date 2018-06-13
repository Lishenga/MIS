<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('batch_id');
            $table->string('Name',1000)->nullable();
            $table->string('Academic_year')->nullable();
            $table->string('Category')->nullable();
            $table->string('Units')->nullable();
            $table->string('grading')->nullable();
            $table->string('Semester')->nullable();
            $table->string('out_of')->nullable();
            $table->string('Status',1000)->nullable();
            $table->string('supplementarypassmark',1000)->nullable();
            $table->string('supmaxattempts',1000)->nullable();
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
        Schema::drop('Exams');
    }
}
