<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LentaProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenta_product', function (Blueprint $table) {
            $table->foreignId("lenta_id")
                ->constrained("lenta")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("product_id")
                ->constrained("products")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->primary(['lenta_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lenta_product');
    }
}
