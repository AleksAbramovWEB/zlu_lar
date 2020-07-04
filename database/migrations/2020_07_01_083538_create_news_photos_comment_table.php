<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPhotosCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_comment_photo', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('comment_id')->unsigned();

            $table->foreign('comment_id')
                ->references('id')
                ->on('photos_comment')
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
        Schema::dropIfExists('news_photos_comment');
    }
}
