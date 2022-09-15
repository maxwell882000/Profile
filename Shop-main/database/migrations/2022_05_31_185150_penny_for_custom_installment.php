<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PennyForCustomInstallment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_penny_installment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("month_paid_id")
                ->constrained("custom_month_paid");
            $table->unsignedDecimal("paid", 50)->default(0);
            $table->bigInteger("transaction_id")->nullable();
        });
        Schema::table('custom_installment', function (Blueprint $table) {
            $table->unsignedDecimal("penny", 50, 0)->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
