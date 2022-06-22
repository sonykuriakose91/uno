<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->text('description');
            $table->string('phone_number');
            $table->string('url');
            $table->string('email',100);
            $table->text('address');
            $table->string('facebook_url');
            $table->string('twitter_url');
            $table->string('instagram_url');
            $table->string('google_plus_url');
            $table->string('linkedin_url');
            $table->text('google_map_api');
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
        Schema::dropIfExists('settings');
    }
}
