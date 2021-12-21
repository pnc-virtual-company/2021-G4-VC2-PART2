<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('company_id')->constrained()->onDelete('CASCADE');
            $table->string('gender')->nullable();
            $table->date('DOB')->nullable();
            $table->string('batch')->nullable();
            $table->string('major')->nullable();
            $table->string('skill')->nullable();
            $table->string('city')->nullable();
            $table->string('maritalStatus')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
