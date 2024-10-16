<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gambars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaduan_id')->nullable();
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('set null');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gambars');
    }
};