<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraderOfferLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader_offer_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('trader_offer_id');
            $table->string('user_type');
            $table->integer('user_id');
            $table->string('reaction',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trader_offer_likes');
    }
}
