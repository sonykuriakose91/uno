<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiyHelpCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diy_help_comments', function (Blueprint $table) {
            $table->id();
            $table->string('user_type',100);
            $table->integer('user_id');
            $table->integer('diy_help_id');
            $table->text('comment');
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
        Schema::dropIfExists('diy_help_comments');
    }
}
