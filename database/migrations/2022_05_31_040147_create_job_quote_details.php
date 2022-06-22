<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobQuoteDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_quote_details', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->integer('job_quote_id');
            $table->integer('job_quote_details_id');
            $table->string('user_type',100);
            $table->integer('user_id');
            $table->text('details');
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
        Schema::dropIfExists('job_quote_details');
    }
}
