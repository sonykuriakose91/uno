<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraderPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('trader_id');
            $table->text('post_content');
            $table->tinyInteger('status');
            $table->string('emoji');
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
        Schema::dropIfExists('trader_posts');
    }
}
