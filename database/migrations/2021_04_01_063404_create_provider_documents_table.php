<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id');
            $table->string('proof_type',100);
            $table->string('id_type',100);
            $table->string('id_number');
            $table->string('document');
            $table->tinyInteger('verified');
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
        Schema::dropIfExists('provider_documents');
    }
}
