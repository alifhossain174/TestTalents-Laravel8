<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->string('email')->nullable();
            $table->string('assesment_slug')->nullable();
            $table->unsignedBigInteger('assesment_id')->nullable();
            $table->string('test_slug')->nullable();
            $table->unsignedBigInteger('test_id')->nullable();
            $table->string('question_slug')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->longText('answer')->nullable();
            $table->double('marks')->default(0);
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
        Schema::dropIfExists('candidate_results');
    }
}
