<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomMonthPaid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_month_paid', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedDecimal("must_pay", 50);
            $table->unsignedDecimal("paid", 50)->default(0);
            $table->date("month");
            $table->bigInteger("transaction_id")->nullable();
            $table->foreignId("taken_credit_id")
                ->constrained("custom_installment")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unique(['month', 'taken_credit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_month_paid');
    }
}
