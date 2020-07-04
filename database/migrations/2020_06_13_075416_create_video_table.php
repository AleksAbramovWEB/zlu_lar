<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('path_video');
            $table->string('path_img');
            $table->string('title_ru');
            $table->string('title_en');
            $table->text('description_ru');
            $table->text('description_en');
            $table->bigInteger('views')->unsigned()->default(0);
            $table->boolean('published')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
