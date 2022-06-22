<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_quotes', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->integer('trader_id');
            $table->text('quote_details');
            $table->tinyInteger('status');
            $table->tinyInteger('detail_request');
            $table->text('detail_req_details');
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
        Schema::dropIfExists('job_quotes');
    }
}
