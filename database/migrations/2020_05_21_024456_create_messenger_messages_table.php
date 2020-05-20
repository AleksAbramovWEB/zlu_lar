<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contact_from')->unsigned()->index();
            $table->foreign('contact_from')->references('user_id')->on('messenger_contacts');
            $table->bigInteger('contact_to')->unsigned()->index();
            $table->foreign('contact_to')->references('user_id')->on('messenger_contacts');
            $table->text('message');
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
        Schema::dropIfExists('messenger_messages');
    }
}
