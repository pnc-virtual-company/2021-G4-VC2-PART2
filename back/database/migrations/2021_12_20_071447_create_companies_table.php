<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('companyName')->nullable();
            $table->string('alumniPosition')->nullable();
            $table->string('companyHR')->nullable();
            $table->string('companyWebsite')->nullable();
            $table->string('companyEmail')->nullable();
            $table->integer('companyContact')->nullable();
            $table->string('companyLocation')->nullable();
            $table->string('companyImage')->nullable();
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
        Schema::dropIfExists('companies');
    }
}