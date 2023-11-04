<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('recharge_date')->nullable();
            $table->double('recharge_amount')->default(0);
            $table->unsignedBigInteger('invitation_limit')->nullable();
            $table->string('agent_no')->nullable();
            $table->string('user_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0=>Not Approved; 1=>Approved");
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
        Schema::dropIfExists('recharge_histories');
    }
}
