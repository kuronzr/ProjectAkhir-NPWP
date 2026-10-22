<?php
require_once '../config/auth.php';
checkAuth();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Keluhan</title>
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
    <h2>Formulir Keluhan</h2>

    <form action="../control/proses_keluhan.php" method="POST">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>

      <label for="jenis">Jenis Keluhan</label>
      <select name="jenis" id="jenis" required>
        <option value="">Pilih Jenis Keluhan</option>
        <option value="layanan">Layanan</option>
        <option value="produk">Teknis</option>
        <option value="teknis">Lainnya</option>
      </select>

      <label for="deskripsi">Deskripsi Keluhan</label>
      <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi keluhan Anda" required></textarea>


      <input type="submit" value="KIRIM">
    </form>


</body>

</html>