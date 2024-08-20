<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaduan_id')->nullable();
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('set null');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('komentar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('komentars');
    }
};