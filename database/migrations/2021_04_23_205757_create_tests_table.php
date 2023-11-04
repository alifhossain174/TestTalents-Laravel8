<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->string("test_name")->nullable();
            $table->tinyInteger('test_type')->nullable();
            $table->longText('test_summary')->nullable();
            $table->longText('test_description')->nullable();
            $table->string('test_time')->comment('In Minute')->nullable();
            $table->string('test_audience')->nullable();
            $table->tinyInteger('test_level')->comment('1=> Entry; 2=> Intermediate; 3=> Expert')->nullable();
            $table->string('test_author_name')->nullable();
            $table->string('test_author_image')->nullable();
            $table->longText('test_author_description')->nullable();
            $table->double('total_marks')->nullable();
            $table->tinyInteger('is_active')->default('1');
            $table->string("slug")->nullable();
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
        Schema::dropIfExists('tests');
    }
}
