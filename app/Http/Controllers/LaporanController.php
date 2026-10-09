<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $laporans = Laporan::query()
            ->when($request->filled('q'), fn ($q) => $q->where(function ($w) use ($request) {
                $w->where('judul', 'like', "%{$request->q}%")
                  ->orWhere('lokasi', 'like', "%{$request->q}%")
                  ->orWhere('teknisi', 'like', "%{$request->q}%");
            }))
            ->when($request->filled('kategori'), fn ($q) => $q->where('kategori', $request->kategori))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('laporans.index', compact('laporans'));
    }

    public function create(): View
    {
        return view('laporans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul' => 'required|max:120',
            'lokasi' => 'required|max:120',
            'kategori' => 'required|in:' . implode(',', Laporan::KATEGORI),
            'prioritas' => 'required|in:' . implode(',', Laporan::PRIORITAS),
            'teknisi' => 'nullable|max:80',
            'deskripsi' => 'nullable|max:2000',
        ], [], [
            'judul' => 'judul', 'lokasi' => 'lokasi', 'kategori' => 'kategori',
            'prioritas' => 'prioritas', 'teknisi' => 'teknisi', 'deskripsi' => 'deskripsi',
        ]);

        $laporan = Laporan::create($data + ['status' => 'Terbuka']);

        return redirect()->route('laporan.show', $laporan)
            ->with('ok', "Laporan {$laporan->nomor} sudah dicatat di buku!");
    }

    public function show(Laporan $laporan): View
    {
        return view('laporans.show', compact('laporan'));
    }

    public function edit(Laporan $laporan): View
    {
        return view('laporans.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan): RedirectResponse
    {
        $data = $request->validate([
            'judul' => 'required|max:120',
            'lokasi' => 'required|max:120',
            'kategori' => 'required|in:' . implode(',', Laporan::KATEGORI),
            'prioritas' => 'required|in:' . implode(',', Laporan::PRIORITAS),
            'status' => 'required|in:' . implode(',', Laporan::STATUS),
            'teknisi' => 'nullable|max:80',
            'deskripsi' => 'nullable|max:2000',
            'tindak_lanjut' => 'nullable|max:2000',
        ]);

        if ($data['status'] === 'Selesai' && $laporan->status !== 'Selesai') {
            $data['closed_at'] = now();
        } elseif ($data['status'] !== 'Selesai') {
            $data['closed_at'] = null;
        }

        $laporan->update($data);

        return redirect()->route('laporan.show', $laporan)
            ->with('ok', "Perubahan {$laporan->nomor} tersimpan.");
    }

    public function destroy(Laporan $laporan): RedirectResponse
    {
        $nomor = $laporan->nomor;
        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('ok', "Halaman $nomor disobek dari buku (dihapus).");
    }
}
