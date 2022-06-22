<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMessagesTable03062022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->tinyInteger('is_trader')->after('product_id');
            $table->integer('trader_id')->after('is_trader');
            $table->tinyInteger('is_job')->after('trader_id');
            $table->integer('job_id')->after('is_job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
