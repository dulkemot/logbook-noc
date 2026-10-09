<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'terbuka' => Laporan::where('status', 'Terbuka')->count(),
            'diproses' => Laporan::where('status', 'Diproses')->count(),
            'selesaiBulanIni' => Laporan::where('status', 'Selesai')
                ->whereMonth('closed_at', now()->month)
                ->whereYear('closed_at', now()->year)
                ->count(),
            'terbaru' => Laporan::latest()->take(5)->get(),
        ]);
    }
}
