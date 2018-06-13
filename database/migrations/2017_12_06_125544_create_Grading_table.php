<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('amin')->nullable();
            $table->string('amax')->nullable();
            $table->string('bmin')->nullable();
            $table->string('bmax')->nullable();
            $table->string('cmin')->nullable();
            $table->string('cmax')->nullable();
            $table->string('dmin')->nullable();
            $table->string('dmax')->nullable();
            $table->string('emin')->nullable();
            $table->string('emax')->nullable();
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
        Schema::drop('grading');
    }
}
