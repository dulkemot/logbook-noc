<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('judul', 'Buku Log NOC')</title>
<style>
  * { box-sizing: border-box; }
  body {
    margin: 0; color: #2b2620;
    font-family: Georgia, 'Times New Roman', serif;
    background-color: #efe8d8;
    background-image: repeating-linear-gradient(#efe8d8 0 30px, #e3dac4 30px 31px);
  }
  .sampul { max-width: 860px; margin: 0 auto; padding: 0 18px 60px; }
  .kop {
    border-bottom: 3px double #8a7a5c; padding: 22px 4px 12px;
    display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 8px;
  }
  .kop .nama { font-family: 'Courier New', monospace; font-weight: bold; font-size: 22px; letter-spacing: 2px; }
  .kop .nama a { color: inherit; text-decoration: none; }
  .kop nav a { font-family: 'Courier New', monospace; font-size: 14px; color: #4a5a8a; margin-left: 14px; }
  .tanggal { font-family: 'Courier New', monospace; font-size: 13px; color: #8a7a5c; margin: 10px 4px 0; }
  .kartu {
    position: relative; background: #fbf7ec; border: 1px solid #d8cdb2;
    border-radius: 4px; padding: 20px; margin-top: 22px;
    box-shadow: 2px 3px 0 rgba(90, 70, 40, .15);
  }
  .kartu::before {
    content: ""; position: absolute; top: -12px; left: 40px; width: 110px; height: 24px;
    background: rgba(255, 138, 0, .35); transform: rotate(-3deg);
    border-left: 1px dashed rgba(120, 80, 20, .4); border-right: 1px dashed rgba(120, 80, 20, .4);
  }
  .flash { background: #e8f3df; border: 1px solid #6a9a4a; border-radius: 4px; padding: 10px 14px; margin-top: 18px; }
  .stamp {
    display: inline-block; font-family: 'Courier New', monospace; font-weight: bold;
    font-size: 13px; letter-spacing: 2px; text-transform: uppercase;
    border: 3px double; border-radius: 6px; padding: 3px 12px; transform: rotate(-4deg);
  }
  .s-Terbuka { color: #b3261e; border-color: #b3261e; }
  .s-Diproses { color: #9a6a00; border-color: #9a6a00; }
  .s-Selesai { color: #2e7d32; border-color: #2e7d32; }
  .p-Darurat { color: #b3261e; font-weight: bold; }
  table { width: 100%; border-collapse: collapse; margin-top: 12px; font-size: 15px; }
  th, td { text-align: left; padding: 9px 8px; border-bottom: 1px dashed #c9bc9c; vertical-align: top; }
  th { font-family: 'Courier New', monospace; font-size: 13px; color: #8a7a5c; }
  a { color: #2a4a9a; }
  .btn {
    display: inline-block; font-family: 'Courier New', monospace; font-size: 14px; font-weight: bold;
    background: #2b2620; color: #fbf7ec; border: none; border-radius: 4px;
    padding: 10px 18px; text-decoration: none; cursor: pointer;
  }
  .btn-kecil { font-size: 13px; padding: 6px 12px; }
  .btn-garis { background: transparent; color: #2b2620; border: 2px solid #2b2620; }
  .btn-merah { background: #b3261e; }
  label { display: block; font-family: 'Courier New', monospace; font-size: 13px; margin: 14px 0 4px; color: #5a4f3c; }
  input, select, textarea {
    width: 100%; font-family: Georgia, serif; font-size: 16px; color: #2b2620;
    background: #fffdf4; border: 1px solid #b8a888; border-radius: 4px; padding: 10px;
  }
  .baris { display: flex; gap: 12px; flex-wrap: wrap; }
  .baris > div { flex: 1; min-width: 150px; }
  .catatan { font-family: 'Segoe Script', 'Comic Sans MS', cursive; color: #4a5a8a; font-size: 14px; }
  .meta { font-family: 'Courier New', monospace; font-size: 13px; color: #8a7a5c; }
  .angka { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 18px; }
  .angka div { flex: 1; min-width: 140px; background: #fbf7ec; border: 1px solid #d8cdb2; border-radius: 4px; padding: 14px; text-align: center; }
  .angka b { font-size: 34px; display: block; font-family: 'Courier New', monospace; }
  footer { margin-top: 40px; border-top: 3px double #8a7a5c; padding-top: 12px; font-size: 13px; color: #8a7a5c; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
  .error { color: #b3261e; font-size: 13px; }
</style>
</head>
<body>
<div class="sampul">
  <div class="kop">
    <div class="nama"><a href="{{ route('dashboard') }}">📓 BUKU LOG NOC</a></div>
    <nav>
      <a href="{{ route('dashboard') }}">Beranda</a>
      <a href="{{ route('laporan.index') }}">Daftar Laporan</a>
      <a href="{{ route('laporan.create') }}">+ Catat Baru</a>
    </nav>
  </div>
  <div class="tanggal">{{ now()->translatedFormat('l, d F Y') }} — shift: {{ now()->hour < 14 ? 'pagi' : (now()->hour < 22 ? 'sore' : 'malam') }}</div>

  @if (session('ok'))
    <div class="flash">✔ {{ session('ok') }}</div>
  @endif

  @yield('isi')

  <footer>
    <span>Logbook gangguan Internet & CCTV — ditulis tangan (pakai keyboard).</span>
    <span class="catatan">jangan lupa backup sebelum pulang! ☕</span>
  </footer>
</div>
</body>
</html>
