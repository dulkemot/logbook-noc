<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'lokasi', 'kategori', 'prioritas', 'status',
        'teknisi', 'deskripsi', 'tindak_lanjut', 'closed_at',
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public const KATEGORI = ['Internet', 'WiFi', 'CCTV', 'Listrik', 'Lainnya'];
    public const PRIORITAS = ['Rendah', 'Normal', 'Darurat'];
    public const STATUS = ['Terbuka', 'Diproses', 'Selesai'];

    public function getNomorAttribute(): string
    {
        return 'NOC-' . str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
    }
}
