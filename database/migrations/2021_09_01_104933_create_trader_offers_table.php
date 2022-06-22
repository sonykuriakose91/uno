<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraderOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader_offers', function (Blueprint $table) {
            $table->id(); 
            $table->integer('trader_id');
            $table->string('title');
            $table->string('full_price');
            $table->string('discount_price');
            $table->string('valid_from');
            $table->string('valid_to');
            $table->tinyInteger('status');
            $table->string('likes');
            $table->string('reactions');
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
        Schema::dropIfExists('trader_offers');
    }
}
