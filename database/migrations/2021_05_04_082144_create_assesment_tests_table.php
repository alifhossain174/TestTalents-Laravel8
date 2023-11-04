<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assesment_id')->nullable();
            $table->string("assesment_slug")->nullable();
            $table->unsignedBigInteger('test_id')->nullable();
            $table->string("test_slug")->nullable();
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
        Schema::dropIfExists('assesment_tests');
    }
}
