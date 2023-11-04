<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id')->nullable();
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('zoom_uuid')->nullable();
            $table->string('zoom_id')->nullable();
            $table->string('zoom_host_id')->nullable();
            $table->string('zoom_host_email')->nullable();
            $table->string('zoom_topic')->nullable();
            $table->tinyInteger('zoom_type')->nullable();
            $table->string('zoom_status')->nullable();
            $table->dateTime('zoom_start_time')->nullable();
            $table->unsignedBigInteger('zoom_duration')->nullable()->comment('In minute');
            $table->string('zoom_timezone')->nullable();
            $table->string('zoom_start_url')->nullable();
            $table->string('zoom_join_url')->nullable();
            $table->string('zoom_password')->nullable();
            $table->string('zoom_h323_password')->nullable();
            $table->string('zoom_pstn_password')->nullable();
            $table->string('zoom_encrypted_password')->nullable();
            $table->tinyInteger('zoom_settings_host_video')->nullable();
            $table->tinyInteger('zoom_settings_participant_video')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('zoom_meetings');
    }
}
