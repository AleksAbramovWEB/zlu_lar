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
            $table->bigInteger('contact_from')->unsigned()->index()->nullable();
            $table->foreign('contact_from')->references('id')->on('messenger_contacts')->onDelete('set null');
            $table->bigInteger('contact_to')->unsigned()->index()->nullable();
            $table->foreign('contact_to')->references('id')->on('messenger_contacts')->onDelete('set null');
            $table->text('message');
            $table->boolean('viewed')->default(0);
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
