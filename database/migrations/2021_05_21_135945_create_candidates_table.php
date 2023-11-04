<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('invited_on')->nullable();
            $table->double('average_score')->default(0);
            $table->double('stage')->default(0)->comment("0=>Not Checked; 1=>Evaluated; 2=>Not Evaluated");
            $table->string('assesment_slug')->nullable();
            $table->tinyInteger('assesment_status')->default(1)->comment("1=>Active; 0=>Inactive");
            $table->unsignedBigInteger('number_of_trial')->default(0);
            $table->string('slug')->nullable();
            $table->string('device_used')->nullable();
            $table->string('os_used')->nullable();
            $table->string('browser_used')->nullable();
            $table->string('location')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('ip_address_status')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
