<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('trader_id');
            $table->integer('user_id');
            $table->string('work_completed',50);
            $table->integer('service_id');
            $table->string('service_date',100);
            $table->text('review');
            $table->integer('reliability');
            $table->integer('tidiness');
            $table->integer('response');
            $table->integer('accuracy');
            $table->integer('pricing');
            $table->integer('overall_exp');
            $table->string('recommend',50);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('reviews');
    }
}
