<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->string('hari');
            $table->string('jam');

            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('gurus');
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
