<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTagihansTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi_tagihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('tagihan_id');
            $table->date('tanggal_bayar');
            $table->decimal('nominal', 10, 2);
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('tagihan_id')->references('id')->on('tagihans');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_tagihans');
    }
}
