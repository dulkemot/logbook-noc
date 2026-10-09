<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 120);
            $table->string('lokasi', 120);
            $table->string('kategori', 20);   // Internet, WiFi, CCTV, Listrik, Lainnya
            $table->string('prioritas', 20);  // Rendah, Normal, Darurat
            $table->string('status', 20)->default('Terbuka'); // Terbuka, Diproses, Selesai
            $table->string('teknisi', 80)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
