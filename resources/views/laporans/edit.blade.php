@extends('layouts.app')

@section('judul', 'Ubah ' . $laporan->nomor . ' — Buku Log NOC')

@section('isi')
<div class="kartu">
  <h2 style="margin-top:0">✏️ Ubah {{ $laporan->nomor }}</h2>
  <form method="POST" action="{{ route('laporan.update', $laporan) }}">
    @csrf @method('PUT')
    <label>Judul gangguan *</label>
    <input name="judul" value="{{ old('judul', $laporan->judul) }}" maxlength="120">
    @error('judul')<div class="error">{{ $message }}</div>@enderror

    <div class="baris">
      <div><label>Lokasi *</label><input name="lokasi" value="{{ old('lokasi', $laporan->lokasi) }}" maxlength="120"></div>
      <div><label>Teknisi</label><input name="teknisi" value="{{ old('teknisi', $laporan->teknisi) }}" maxlength="80"></div>
    </div>
    <div class="baris">
      <div><label>Kategori *</label>
        <select name="kategori">
          @foreach (\App\Models\Laporan::KATEGORI as $k)
            <option value="{{ $k }}" @selected(old('kategori', $laporan->kategori) === $k)>{{ $k }}</option>
          @endforeach
        </select>
      </div>
      <div><label>Prioritas *</label>
        <select name="prioritas">
          @foreach (\App\Models\Laporan::PRIORITAS as $p)
            <option value="{{ $p }}" @selected(old('prioritas', $laporan->prioritas) === $p)>{{ $p }}</option>
          @endforeach
        </select>
      </div>
      <div><label>Status *</label>
        <select name="status">
          @foreach (\App\Models\Laporan::STATUS as $s)
            <option value="{{ $s }}" @selected(old('status', $laporan->status) === $s)>{{ $s }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <label>Deskripsi awal</label>
    <textarea name="deskripsi" rows="3" maxlength="2000">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>

    <label>Tindak lanjut</label>
    <textarea name="tindak_lanjut" rows="3" maxlength="2000" placeholder="cth: Ganti adaptor PoE, ping stabil 2ms — Budi">{{ old('tindak_lanjut', $laporan->tindak_lanjut) }}</textarea>

    <p><button class="btn" type="submit">💾 Simpan perubahan</button>
    <a class="btn btn-garis" href="{{ route('laporan.show', $laporan) }}">Batal</a></p>
  </form>
</div>
@endsection
