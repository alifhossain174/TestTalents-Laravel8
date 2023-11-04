<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_testimonials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('referee_name')->nullable();
            $table->string('email')->nullable();
            $table->string('project_type')->nullable();
            $table->longText('msg')->nullable();
            $table->longText('reply')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('status')->comment('1=> Approved; 0=>Not Approved')->default(0);
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
        Schema::dropIfExists('candidate_testimonials');
    }
}
