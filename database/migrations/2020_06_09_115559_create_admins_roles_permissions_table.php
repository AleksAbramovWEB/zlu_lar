<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_roles_permissions', function (Blueprint $table) {

            $table->bigInteger('roles_id')->unsigned();
            $table->foreign('roles_id')
                ->references('id')
                ->on('admins_roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('permissions_id')->unsigned();
            $table->foreign('permissions_id')
                ->references('id')
                ->on('admins_permissions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['roles_id','permissions_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_roles_permissions');
    }
}
