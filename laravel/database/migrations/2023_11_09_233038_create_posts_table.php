<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Relación 1:N con users
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');

            // Relación 1:1 con files
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['author_id']);
            $table->dropForeign(['file_id']);
        });

        Schema::dropIfExists('posts');
    }
};