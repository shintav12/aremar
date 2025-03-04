<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_object', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('menu_active',50);
            $table->string('description',100);
            $table->integer('father_id');
            $table->string('location',50);
            $table->integer('position');
            $table->string('icon',100)->nullable();
            $table->boolean('father');
            $table->boolean('status');
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
        Schema::dropIfExists('auth_object');
    }
}
