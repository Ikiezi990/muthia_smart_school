<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('siswa_id');
            $table->date('tanggal_absensi');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alpa']);
            $table->timestamps();

            // Definisikan foreign key untuk relasi dengan tabel jadwal
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade');

            // Definisikan foreign key untuk relasi dengan tabel siswa
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};
