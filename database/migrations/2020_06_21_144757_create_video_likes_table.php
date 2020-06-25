<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_likes', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('video_id')
                ->unsigned()
                ->index();

            $table->foreign('video_id')
                ->references('id')
                ->on('video')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('user_id')
                ->unsigned()
                ->index()
                ->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_likes');
    }
}
