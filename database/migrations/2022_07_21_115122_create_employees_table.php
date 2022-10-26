<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_no');
            $table->string('inital')->nullable();
            $table->string('surname')->nullable();
            $table->string('paypoint')->nullable();
            $table->string('selection_1')->nullable();
            $table->string('selection_2')->nullable();
            $table->string('selection_3')->nullable();
            $table->string('shift_bear')->nullable();
            $table->string('other_bear')->nullable();
            $table->string('signature')->nullable();
            $table->enum('status', ['0', '1']);
            $table->string('date');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('employees');
    }
}
