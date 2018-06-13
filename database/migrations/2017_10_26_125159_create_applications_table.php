<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Status')->default('1');
            $table->date('admission_date')->nullable();
            $table->string('first_name',250)->nullable();
            $table->string('middle_names',250)->nullable();
            $table->date('dob')->nullable();
            $table->string('Marital_Status')->default('SINGLE');
            $table->string('Gender',250)->nullable();
            $table->string('nationality')->default('KENYAN');
            $table->string('National_id', 300)->nullable();
            $table->string('postal_address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('Accommodation',250)->nullable();
            $table->string('email_address',250)->nullable();
            $table->string('Parent_names',400)->nullable();
            $table->string('Relationship',400)->nullable();
            $table->string('Address',400)->nullable();
            $table->string('Phone_number',400)->nullable();
            $table->string('Physical',10)->nullable();
            $table->string('Description',1000)->nullable();
            $table->string('Finances',10)->nullable();
            $table->string('FinancesDescription',1000)->nullable();
            $table->string('image',1000)->nullable();
            $table->string('course_id')->nullable();
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
        //
        Schema::drop('applications');
    }
}
