<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomInstallment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_installment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger("transaction_id")->nullable();
            $table->unsignedDecimal("price", 50);
            $table->unsignedDecimal('initial_price', 50)->default(0);
            $table->string("name");
            $table->integer("status")->default(\App\Domain\Installment\Interfaces\PurchaseStatus::WAIT_ANSWER);
            $table->dateTime('date_taken')->nullable();
            $table->unsignedDecimal("penny", 50, 0)->default(0)->nullable();
            $table->dateTime('date_finish')->nullable();
            $table->bigInteger("contract_num")->unique();
            $table->text("product");
            $table->foreignUuid("plastic_id")->nullable()
                ->constrained("plastic_card")
                ->restrictOnDelete();
            $table->foreignId("credit_id")
                ->constrained("credits")
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_installment');
    }
}
