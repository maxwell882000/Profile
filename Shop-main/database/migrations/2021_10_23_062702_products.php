<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('title');
            $table->unsignedDecimal('price', 50);
            $table->smallInteger("currency");
            $table->integer("number");
            $table->integer("weight");// weight in kg
            $table->boolean("is_important")->default(false);
            $table->integer('percentage')->default(0); // discount percentage
            $table->string("slug")->unique();
            $table->foreignId('category_id')->constrained('categories')
                ->restrictOnDelete();
            $table->foreignId('shop_id')->constrained('users')->onUpdate('CASCADE')
                ->restrictOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->onUpdate('CASCADE')
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
        Schema::dropIfExists('product');
    }
}
