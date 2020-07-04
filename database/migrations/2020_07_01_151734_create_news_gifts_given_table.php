<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsGiftsGivenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_gifts_given', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('gifts_given_id')->unsigned();

            $table->foreign('gifts_given_id')
                ->references('id')
                ->on('gifts_given')
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
        Schema::dropIfExists('news_gifts_given');
    }
}
