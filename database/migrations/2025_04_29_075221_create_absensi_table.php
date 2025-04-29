<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rapat')->constrained('rapat')->onDelete('cascade');
            $table->string('nama_peserta');
            $table->string('nip_peserta');
            $table->enum('status_kehadiran', ['Hadir', 'Tidak Hadir']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
