<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Basket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // from basket goes to user order if user purchase the product
    public function up()
    {
        Schema::create('basket', function (Blueprint $table) {
            $table->foreignId("order_id") // not the product
            ->primary()
                ->constrained("orders")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("user_id")
                ->constrained("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("order_delivery_id")
                ->nullable()
                ->constrained("order_deliveries")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket');
    }
}
