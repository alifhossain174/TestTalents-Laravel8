<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('assesment_id')->nullable();
            $table->tinyInteger('question_type')->comment('1=> MCQ; 2=> OpenEnded; 3=>FileWithMcq; 4=>FileWithOpenEnded')->nullable();
            $table->longText('passage')->nullable();
            $table->longText('question')->nullable();
            $table->string('question_file')->nullable();
            $table->longText('answer')->nullable();
            $table->double('marks')->nullable();
            $table->double('time')->nullable();
            $table->tinyInteger('is_active')->default('1');
            $table->string('slug')->nullable();
            $table->string('batch')->nullable();
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
        Schema::dropIfExists('question_banks');
    }
}
