<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('title')->after('sub_category_id');
            $table->string('budget')->after('description');
            $table->string('job_completion')->after('budget');
            $table->string('job_status')->after('status');
            $table->tinyInteger('material_purchased')->after('job_status');
            $table->integer('job_views')->after('material_purchased');
            $table->tinyInteger('quote_provided')->after('job_views');
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
