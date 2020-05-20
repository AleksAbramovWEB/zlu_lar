<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned(); // владелец
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('user_contact')->index()->unsigned(); // с кем
            $table->foreign('user_contact')->references('id')->on('users');
            $table->bigInteger('user_creator')->index()->unsigned();// инициатор контакта
            $table->foreign('user_creator')->references('id')->on('users');
            $table->string('category', 20)->index(); // категория
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
        Schema::dropIfExists('messenger_contacts');
    }
}
