<?php
require_once '../config/auth.php';
checkAuth(); // Jika Guest mencoba masuk, akan langsung dialihkan ke login.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Kehilangan</title>
  <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
  <header>
    <h1><a href="home.php">Yaudah LostnFound</a></h1>
    <nav>
      <ul>
        <li><a href="home.php">Beranda</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Laporkan Barang <span class="caret">&#9662;</span></a>
          <ul class="dropdown-menu">
            <li><a href="form_khilangan.php">Laporan Kehilangan</a></li>
            <li><a href="form_nemu.php">Laporan Menemukan</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Help <span class="caret">&#9662;</span></a>
          <ul class="dropdown-menu">
            <li><a href="about.php">About</a></li>
            <li><a href="about.php#faq">FAQ</a></li>
            <li><a href="form_keluhan.php">Customer Service</a></li>
          </ul>
        </li>
        <li><a href="testimoni.php">Testimoni</a></li>
        <li><a href="profile.php">Profil Saya</a></li>
        <li><a href="../control/proses_veriv.php?action=logout"
            onclick="return confirm('Yakin ingin logout?')">Keluar</a></li>
      </ul>
    </nav>
  </header>

  <div class="form-container">
    <h2>Formulir Kehilangan</h2>

    <form action="../control/proses_khilangan.php" method="POST" enctype="multipart/form-data">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>

      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="elektronik">Elektronik</option>
        <option value="pakaian">Pakaian</option>
        <option value="perhiasan">Perhiasan</option>
        <option value="lainnya">Lainnya</option>
      </select>

      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi barang yang hilang" required></textarea>

      <label for="tanggal">Terakhir Dilihat</label>

      <input type="text" name="tempat" id="tempat" placeholder="Masukkan tempat terakhir dilihat" required>
      <input type="date" name="tanggal" id="tanggal" placeholder="Masukkan tanggal terakhir dilihat" required>

      <label for="notelp">Nomor Telepon</label>
      <input type="text" name="notelp" id="notelp" placeholder="Masukkan nomor telepon Anda" required>

      <label for="gambar">Gambar (minimal 3)</label>
      <input type="file" name="gambar[]" id="gambar" accept="image/*" multiple>
      <label for="gambar" class="border_kotak dropzone" id="dropzone">
        <span>+</span>
        <small>Klik untuk pilih gambar atau seret ke sini</small>
      </label>
      <p id="gambar-info" class="gambar-info">0 gambar dipilih</p>

      <div id="preview-list" class="preview-list"></div>
      <p id="gambar-error" class="gambar-error hidden"></p>

      <input type="submit" value="KIRIM">
    </form>
  </div>

  <script src="../public/js/form.js"></script>
</body>

</html>