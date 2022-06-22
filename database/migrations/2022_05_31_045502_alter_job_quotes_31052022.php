<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobQuotes31052022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('job_quotes', function (Blueprint $table) {
            $table->tinyInteger('seek_quote')->after('detail_req_details_reply');
            $table->tinyInteger('give_quote')->after('seek_quote');
            $table->string('quoted_price',100)->after('give_quote');
            $table->text('quote_reason')->after('quoted_price');
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
