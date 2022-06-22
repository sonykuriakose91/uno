<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->string('web_url')->after('email');
            $table->text('landmark')->after('loc_longitude');
            $table->double('land_latitude')->after('landmark');
            $table->double('land_longitude')->after('land_latitude');
            $table->text('landmark_data')->after('land_longitude');
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
