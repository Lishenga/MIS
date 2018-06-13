<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsForNextSemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units_for_next_sem', function (Blueprint $table) {
            $table->increments('id');
            $table->string('batch_id');
            $table->string('units', 1000)->nullable();
            $table->string('academic_year')->nullable();
            $table->string('academic_semester')->nullable();
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
        Schema::drop('units_for_next_sem');
    }
}
