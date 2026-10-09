@extends('layouts.app')

@section('judul', $laporan->nomor . ' — Buku Log NOC')

@section('isi')
<div class="kartu">
  <p><span class="stamp s-{{ $laporan->status }}">{{ $laporan->status }}</span></p>
  <h2 style="margin-bottom:2px">{{ $laporan->nomor }} — {{ $laporan->judul }}</h2>
  <p class="meta">Dicatat {{ $laporan->created_at->translatedFormat('l, d F Y H:i') }}
  @if ($laporan->closed_at) • selesai {{ $laporan->closed_at->translatedFormat('d F Y H:i') }} @endif</p>
  <table>
    <tr><th style="width:130px">Lokasi</th><td>{{ $laporan->lokasi }}</td></tr>
    <tr><th>Kategori</th><td>{{ $laporan->kategori }}</td></tr>
    <tr><th>Prioritas</th><td><span class="p-{{ $laporan->prioritas }}">{{ $laporan->prioritas }}</span></td></tr>
    <tr><th>Teknisi</th><td>{{ $laporan->teknisi ?: '— belum ada yang pegang —' }}</td></tr>
    <tr><th>Deskripsi</th><td>{{ $laporan->deskripsi ?: '—' }}</td></tr>
    <tr><th>Tindak lanjut</th><td>{{ $laporan->tindak_lanjut ?: '—' }}</td></tr>
  </table>
  <p>
    <a class="btn btn-kecil" href="{{ route('laporan.edit', $laporan) }}">✏️ Ubah / update status</a>
    <a class="btn btn-kecil btn-garis" href="{{ route('laporan.index') }}">← Kembali</a>
  </p>
  <form method="POST" action="{{ route('laporan.destroy', $laporan) }}" onsubmit="return confirm('Sobek halaman ini dari buku?')">
    @csrf @method('DELETE')
    <button class="btn btn-kecil btn-merah" type="submit">🗑 Sobek halaman</button>
  </form>
</div>
@endsection
