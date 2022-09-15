<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PennyForTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penny_for_transaction', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("month_paid_id")
                ->constrained("month_paid");
            $table->unsignedDecimal("paid", 50)->default(0);
            $table->bigInteger("transaction_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peny_for_transaction');
    }
}
