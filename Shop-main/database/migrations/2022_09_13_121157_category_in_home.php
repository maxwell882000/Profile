<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryInHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_in_home', function (Blueprint $table) {
            $table->foreignId("category_id")
                ->primary()
                ->constrained("categories")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string("color");
            $table->string("back_color");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_in_home');

    }
}
