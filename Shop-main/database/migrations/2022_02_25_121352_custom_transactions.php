<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger("transaction_id");
            $table->unsignedDecimal('amount', 50);
            $table->string("type")->default("");
            $table->foreignId("month_id")
                ->constrained("custom_month_paid")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_transactions');
    }
}
