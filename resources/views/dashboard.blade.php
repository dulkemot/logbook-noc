@extends('layouts.app')

@section('judul', 'Beranda — Buku Log NOC')

@section('isi')
<div class="angka">
  <div><b>{{ $terbuka }}</b>Terbuka 🔴</div>
  <div><b>{{ $diproses }}</b>Diproses 🟡</div>
  <div><b>{{ $selesaiBulanIni }}</b>Selesai bulan ini ✅</div>
</div>

<div class="kartu">
  <h2 style="margin-top:0">Catatan terbaru</h2>
  @forelse ($terbaru as $l)
    <p>
      <span class="stamp s-{{ $l->status }}">{{ $l->status }}</span>
      <a href="{{ route('laporan.show', $l) }}"><b>{{ $l->nomor }} — {{ $l->judul }}</b></a><br>
      <span class="meta">{{ $l->lokasi }} • {{ $l->kategori }} • {{ $l->created_at->diffForHumans() }}</span>
    </p>
  @empty
    <p class="catatan">Buku masih kosong — hari yang tenang... atau belum ada yang mencatat? 😄</p>
  @endforelse
  <p><a class="btn" href="{{ route('laporan.create') }}">+ Catat laporan baru</a></p>
</div>
@endsection
