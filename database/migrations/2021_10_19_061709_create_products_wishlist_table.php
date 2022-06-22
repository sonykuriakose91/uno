<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_wishlist', function (Blueprint $table) {
            $table->id();
            $table->string('user_type',50);
            $table->integer('user_id');
            $table->integer('product_id');
            $table->tinyInteger('shortlist');
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
        Schema::dropIfExists('products_wishlist');
    }
}
