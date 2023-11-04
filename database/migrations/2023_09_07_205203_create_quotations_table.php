<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('recharge_history_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('company_name')->nullable();
            $table->string('attachment')->nullable();
            $table->double('paid_amount')->default(0);
            $table->string('tran_id')->nullable();
            $table->double('invitation_wanted')->default(0);
            $table->double('invitation_given')->default(0);
            $table->double('validity_given')->nullable();
            $table->string('slug');
            $table->tinyInteger('status')->default(0)->comment("0=>Pending; 1=>Approved; 2=>Cancelled");
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
        Schema::dropIfExists('quotations');
    }
}
