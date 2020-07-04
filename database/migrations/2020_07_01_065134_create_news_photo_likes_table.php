<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPhotoLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_likes_photo', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->bigInteger('like_id')->unsigned();

            $table->foreign('like_id')
                  ->references('id')
                  ->on('photos_likes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->bigInteger('views')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
