<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlasticCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
     *  plastic card_number and card_token must be unique so no other user could use this card
     *  but deletion must be considered thoroughaly
     * */
    public function up()
    {
        Schema::create('plastic_card', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->string("card_number");
            $table->string("expiry");
            $table->string("phone");
            $table->unsignedBigInteger("card_id")->nullable();
            $table->string("card_token")->nullable(); //will be used
            $table->string("pan")->nullable();/// see what are comming here
            ///  because maybe card number is not necessary
            $table->boolean("activated")->default(true); // true activated | false deactivated
            $table->string("card_holder")->default("");
            $table->index('card_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plastic_card');
    }
}
