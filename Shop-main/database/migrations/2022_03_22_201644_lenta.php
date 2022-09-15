<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json("text");
            $table->integer("order")->default(0);
            $table->json("left_image");// either one side of the view
            $table->boolean("is_left");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lenta');
    }
}
