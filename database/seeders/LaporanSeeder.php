<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['Internet lambat di lobi utama', 'Hotel Mawar', 'Internet', 'Darurat', 'Terbuka', 'Budi (Tim 1)', 'Tamu komplain streaming putus-putus sejak check-in rombongan.'],
            ['CCTV parkir mati 2 channel', 'Hotel Mawar', 'CCTV', 'Darurat', 'Diproses', 'Agus (Tim 2)', 'Channel 5-6 no signal, DVR nyala. Dugaan adaptor PoE.', 'Adaptor diganti, observasi 1x24 jam.'],
            ['WiFi kamar 201-205 hilang', 'Hotel Melati', 'WiFi', 'Normal', 'Selesai', 'Budi (Tim 1)', 'AP lantai 2 restart sendiri.', 'Kabel PoE korosi diganti + AP diadopsi ulang.'],
            ['Billing hotspot tidak keluar voucher', 'Resto Pesisir', 'Internet', 'Normal', 'Selesai', '-', 'User Manager penuh, database corrupt.', 'Reset database UM, cetak ulang 50 voucher.'],
            ['Listrik server room padam sesaat', 'Kantor Pusat', 'Listrik', 'Darurat', 'Selesai', 'Agus (Tim 2)', 'UPS bunyi terus, baterai drop.', 'Baterai UPS diganti 2 unit.'],
            ['Kamera lobi blur', 'Hotel Anggrek', 'CCTV', 'Rendah', 'Terbuka', null, 'Lensa berembun tiap pagi hari.', null],
            ['Speedtest kantor cuma 10 Mbps', 'Kantor Pusat', 'Internet', 'Normal', 'Diproses', 'Citra (Tim 1)', 'Paket 50 Mbps, curiga limit queue lama.', null],
            ['AP aula sering disconnect', 'Villa Karang', 'WiFi', 'Normal', 'Terbuka', null, '40+ client berebut 1 AP.', null],
            ['NVR bunyi beep tiap jam', 'Hotel Melati', 'CCTV', 'Rendah', 'Selesai', '-', 'HDD bad sector.', 'HDD 4TB diganti, format ulang.'],
            ['VPN ke kantor cabang putus', 'Kantor Pusat', 'Internet', 'Darurat', 'Diproses', 'Agus (Tim 2)', 'Tunnel WireGuard down setelah ganti ISP.', null],
            ['Portal hotspot tampil lambat', 'Hotel Anggrek', 'WiFi', 'Rendah', 'Terbuka', null, 'Gambar background 8MB.', null],
            ['Cek rutin mingguan', 'Semua site', 'Lainnya', 'Rendah', 'Selesai', 'Tim 1+2', 'Patroli sinyal, suhu rak, dan backup config.', 'Semua normal, config ter-backup.'],
        ];

        foreach ($rows as $r) {
            [$judul, $lokasi, $kategori, $prioritas, $status, $teknisi, $deskripsi, $tindak] = array_pad($r, 8, null);
            Laporan::create([
                'judul' => $judul, 'lokasi' => $lokasi, 'kategori' => $kategori,
                'prioritas' => $prioritas,
                'status' => $status,
                'teknisi' => $teknisi === '-' ? null : $teknisi,
                'deskripsi' => $deskripsi, 'tindak_lanjut' => $tindak,
                'closed_at' => $status === 'Selesai' ? now()->subDays(rand(1, 20)) : null,
                'created_at' => now()->subDays(rand(0, 25)),
            ]);
        }
    }
}
