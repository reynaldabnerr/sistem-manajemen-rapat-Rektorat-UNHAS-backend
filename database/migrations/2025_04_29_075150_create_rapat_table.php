<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapat', function (Blueprint $table) {
            $table->id();
            $table->string('judul_rapat');
            $table->date('tanggal_rapat');
            $table->string('lokasi_rapat');
            $table->text('deskripsi_rapat')->nullable();
            $table->string('link_absensi')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapat');
    }
};
