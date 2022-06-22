<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderServiceLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_service_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id');
            $table->integer('service_id');
            $table->text('location');
            $table->double('latitude');
            $table->integer('longitude');
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
        Schema::dropIfExists('provider_service_locations');
    }
}
