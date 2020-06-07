<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsGivenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts_given', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('gift_id')->unsigned()->index();
            $table->foreign('gift_id')
                ->references('id')
                ->on('gifts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('whom_user_id')->unsigned()->index();
            $table->foreign('whom_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('from_user_id')->unsigned()->index()->nullable();
            $table->foreign('from_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('set null');

            $table->boolean('not_visible')->default(0);

            $table->string('comment', 200)->nullable();

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
        Schema::dropIfExists('gifts_given');
    }
}
