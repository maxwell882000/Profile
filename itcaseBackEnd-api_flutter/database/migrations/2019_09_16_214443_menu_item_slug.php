<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuItemSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_items', function ($table) {
            $table->string('ru_slug')->nullable();
            $table->string('en_slug')->nullable();
            $table->string('uz_slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('ru_slug');
            $table->dropColumn('en_slug');
            $table->dropColumn('uz_slug');
        });
    }
}
