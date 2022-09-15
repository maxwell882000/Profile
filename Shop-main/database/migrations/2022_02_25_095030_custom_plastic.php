<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomPlastic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_plastic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taken_credit_id')
                ->constrained("custom_installment")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignUuid('plastic_id')
                ->constrained("plastic_card")
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
        Schema::dropIfExists('custom_plastic');
    }
}
