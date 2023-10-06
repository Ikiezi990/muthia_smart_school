<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinerjaSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('tabel_kinerja_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kinerja_id');
            $table->integer('poin');
            $table->timestamps();

            // Definisikan foreign key ke tabel siswa
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');

            // Definisikan foreign key ke tabel kinerja
            $table->foreign('kinerja_id')->references('id')->on('kinerjas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tabel_kinerja_siswa');
    }
}
