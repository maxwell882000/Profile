<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomTimeScheduleTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_time_schedule_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("detail");
            $table->integer("status")->default(\App\Domain\Installment\Interfaces\TimeScheduleInterface::SUCCESS);
            $table->foreignId("taken_credit_id")
                ->constrained('custom_installment')
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
        Schema::dropIfExists('custom_time_schedule_transactions');
    }
}
