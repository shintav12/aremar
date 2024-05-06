<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthRoleObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_role_object', function (Blueprint $table) {
            $table->unsignedBigInteger('object_id');
            $table->foreign('object_id')->references('id')->on('auth_object');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('auth_role');
            $table->enum('permission',['A','W','R']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('auth_role_object');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
