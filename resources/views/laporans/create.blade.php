@extends('layouts.app')

@section('judul', 'Catat Laporan — Buku Log NOC')

@section('isi')
<div class="kartu">
  <h2 style="margin-top:0">✏️ Catat laporan baru</h2>
  <p class="catatan">Tulis yang jelas ya — yang baca bisa jadi shift malam.</p>
  <form method="POST" action="{{ route('laporan.store') }}">
    @csrf
    <label>Judul gangguan *</label>
    <input name="judul" value="{{ old('judul') }}" maxlength="120" placeholder="cth: Internet lambat di lobi utama">
    @error('judul')<div class="error">{{ $message }}</div>@enderror

    <div class="baris">
      <div><label>Lokasi *</label><input name="lokasi" value="{{ old('lokasi') }}" maxlength="120" placeholder="cth: Hotel Mawar lt. 2">
      @error('lokasi')<div class="error">{{ $message }}</div>@enderror</div>
      <div><label>Teknisi</label><input name="teknisi" value="{{ old('teknisi') }}" maxlength="80" placeholder="cth: Budi (Tim 1)"></div>
    </div>
    <div class="baris">
      <div><label>Kategori *</label>
        <select name="kategori">
          @foreach (\App\Models\Laporan::KATEGORI as $k)
            <option value="{{ $k }}" @selected(old('kategori') === $k)>{{ $k }}</option>
          @endforeach
        </select>
      </div>
      <div><label>Prioritas *</label>
        <select name="prioritas">
          @foreach (\App\Models\Laporan::PRIORITAS as $p)
            <option value="{{ $p }}" @selected(old('prioritas', 'Normal') === $p)>{{ $p }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <label>Deskripsi awal</label>
    <textarea name="deskripsi" rows="4" maxlength="2000" placeholder="Gejala, sejak kapan, info akses...">{{ old('deskripsi') }}</textarea>

    <p><button class="btn" type="submit">📝 Catat ke buku</button></p>
  </form>
</div>
@endsection
