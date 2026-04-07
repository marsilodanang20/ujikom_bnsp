<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('id_peserta');
            $table->string('kd_jurusan', 10);
            $table->string('nm_peserta', 100);
            $table->enum('jekel', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->timestamps();

            $table->foreign('kd_jurusan')->references('kd_jurusan')->on('jurusan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
