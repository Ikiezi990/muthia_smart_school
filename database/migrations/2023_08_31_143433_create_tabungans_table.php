<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTabungansTable extends Migration
{
    public function up()
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->decimal('nominal', 10, 2);
            $table->date('tanggal_menabung');
            $table->timestamps();
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tabungans');
    }
}
