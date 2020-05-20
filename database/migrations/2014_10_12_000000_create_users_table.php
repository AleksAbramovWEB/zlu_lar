<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('country')->unsigned()->index();
            $table->foreign('country')->references('id')->on('geo_countries');
            $table->integer('region')->unsigned()->index();
            $table->foreign('region')->references('id')->on('geo_regions');
            $table->integer('city')->unsigned()->index();
            $table->foreign('city')->references('id')->on('geo_cities');
            $table->timestamp('birthday');
            $table->string('position', 20);
            $table->string('gender', 10);
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('about')->nullable();
            $table->text('interests')->nullable();
            $table->text('taboo')->nullable();
            $table->string('greeting')->nullable();
            $table->timestamp('last_time')->nullable();
            $table->timestamp('vip')->nullable();
            $table->integer('coins')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
