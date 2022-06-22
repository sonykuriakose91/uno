<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('type',50);
            $table->string('name');
            $table->string('email',100);
            $table->string('country_code',50);
            $table->string('mobile',50);
            $table->text('address');
            $table->text('location');
            $table->double('loc_latitude');
            $table->double('loc_longitude');
            $table->integer('available_time_from');
            $table->integer('available_time_to');
            $table->tinyInteger('is_available');
            $table->tinyInteger('status');
            $table->tinyInteger('featured');
            $table->tinyInteger('reference');
            $table->float('rating');
            $table->string('profile_pic');
            $table->string('qrcode');
            $table->text('completed_works');
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
        Schema::dropIfExists('providers');
    }
}
