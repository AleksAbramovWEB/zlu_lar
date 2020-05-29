<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerPhotoSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_photo_send', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('message_id')->unsigned()->index();
            $table->foreign('message_id')->references('id')->on('messenger_messages')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('photo_id')->unsigned()->index();
            $table->foreign('photo_id')->references('id')->on('messenger_photos')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('messenger_photo_send');
    }
}
