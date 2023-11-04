<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->id();
            $table->string("pg_txnid")->nullable();
            $table->string("mer_txnid")->nullable();
            $table->string("risk_title")->nullable();
            $table->string("risk_level")->nullable();
            $table->string("cus_name")->nullable();
            $table->string("cus_email")->nullable();
            $table->string("cus_phone")->nullable();
            $table->string("desc")->nullable();
            $table->string("cus_add1")->nullable();
            $table->string("cus_add2")->nullable();
            $table->string("cus_city")->nullable();
            $table->string("cus_state")->nullable();
            $table->string("cus_postcode")->nullable();
            $table->string("cus_country")->nullable();
            $table->string("cus_fax")->nullable();
            $table->string("ship_name")->nullable();
            $table->string("ship_add1")->nullable();
            $table->string("ship_add2")->nullable();
            $table->string("ship_city")->nullable();
            $table->string("ship_state")->nullable();
            $table->string("ship_postcode")->nullable();
            $table->string("ship_country")->nullable();
            $table->string("merchant_id")->nullable();
            $table->string("store_id")->nullable();
            $table->string("amount")->nullable();
            $table->string("amount_bdt")->nullable();
            $table->string("pay_status")->nullable();
            $table->string("status_code")->nullable();
            $table->string("status_title")->nullable();
            $table->string("cardnumber")->nullable();
            $table->string("approval_code")->nullable();
            $table->string("payment_processor")->nullable();
            $table->string("bank_trxid")->nullable();
            $table->string("payment_type")->nullable();
            $table->string("error_code")->nullable();
            $table->string("error_title")->nullable();
            $table->string("bin_country")->nullable();
            $table->string("bin_issuer")->nullable();
            $table->string("bin_cardtype")->nullable();
            $table->string("bin_cardcategory")->nullable();
            $table->string("date")->nullable();
            $table->string("date_processed")->nullable();
            $table->string("amount_currency")->nullable();
            $table->string("rec_amount")->nullable();
            $table->string("processing_ratio")->nullable();
            $table->string("processing_charge")->nullable();
            $table->string("ip")->nullable();
            $table->string("currency")->nullable();
            $table->string("currency_merchant")->nullable();
            $table->string("convertion_rate")->nullable();
            $table->string("opt_a")->nullable();
            $table->string("opt_b")->nullable();
            $table->string("opt_c")->nullable();
            $table->string("opt_d")->nullable();
            $table->string("verify_status")->nullable();
            $table->string("call_type")->nullable();
            $table->string("email_send")->nullable();
            $table->string("doc_recived")->nullable();
            $table->string("checkout_status")->nullable();
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
        Schema::dropIfExists('payment_infos');
    }
}
