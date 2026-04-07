<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id_daftar');
            $table->unsignedBigInteger('id_peserta');
            $table->string('kd_jurusan', 10);
            $table->date('tgl_daftar');
            $table->enum('status', ['Aktif', 'Selesai', 'Batal'])->default('Aktif');
            $table->timestamps();

            $table->foreign('id_peserta')->references('id_peserta')->on('peserta')->onDelete('cascade');
            $table->foreign('kd_jurusan')->references('kd_jurusan')->on('jurusan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
