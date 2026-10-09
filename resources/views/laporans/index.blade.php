@extends('layouts.app')

@section('judul', 'Daftar Laporan — Buku Log NOC')

@section('isi')
<div class="kartu">
  <h2 style="margin-top:0">Daftar Laporan</h2>
  <form method="GET" action="{{ route('laporan.index') }}">
    <div class="baris">
      <div><label>Cari</label><input name="q" value="{{ request('q') }}" placeholder="judul / lokasi / teknisi"></div>
      <div><label>Kategori</label>
        <select name="kategori">
          <option value="">— semua —</option>
          @foreach (\App\Models\Laporan::KATEGORI as $k)
            <option value="{{ $k }}" @selected(request('kategori') === $k)>{{ $k }}</option>
          @endforeach
        </select>
      </div>
      <div><label>Status</label>
        <select name="status">
          <option value="">— semua —</option>
          @foreach (\App\Models\Laporan::STATUS as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <p><button class="btn btn-kecil" type="submit">🔍 Saring</button>
    <a class="btn btn-kecil btn-garis" href="{{ route('laporan.index') }}">Reset</a></p>
  </form>

  <table>
    <tr><th>No</th><th>Laporan</th><th>Status</th></tr>
    @forelse ($laporans as $l)
      <tr>
        <td class="meta">{{ $l->nomor }}</td>
        <td>
          <a href="{{ route('laporan.show', $l) }}"><b>{{ $l->judul }}</b></a><br>
          <span class="meta">{{ $l->lokasi }} • {{ $l->kategori }} • <span class="p-{{ $l->prioritas }}">{{ $l->prioritas }}</span> • {{ $l->created_at->format('d/m/Y H:i') }}</span>
        </td>
        <td><span class="stamp s-{{ $l->status }}">{{ $l->status }}</span></td>
      </tr>
    @empty
      <tr><td colspan="3" class="catatan">Tidak ada yang cocok. Coba kata kunci lain.</td></tr>
    @endforelse
  </table>
  <p>{{ $laporans->links() }}</p>
</div>
@endsection
