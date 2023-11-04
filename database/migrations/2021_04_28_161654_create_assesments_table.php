<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('field')->comment("1=> Corporate; 2=> Academic");
            $table->unsignedBigInteger('job_role')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment("1=>Active; 0=>InActive");
            $table->double('total_marks')->nullable();
            $table->double('total_mins')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('is_deleted')->default(0)->comment("1=>Deleted; 0=>Not Deleted");
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
        Schema::dropIfExists('assesments');
    }
}
