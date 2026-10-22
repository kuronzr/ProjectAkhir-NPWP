<?php
require_once '../config/auth.php';
checkAuth();

$namaUser = $_SESSION['user']['nama'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kirim Testimoni - Yaudah LostnFound</title>
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

  <main>
    <section class="testi-form-wrap">
      <div class="form-container">
        <h2>Kirim Testimoni</h2>

        <form action="../control/proses_testi.php" method="POST" enctype="multipart/form-data">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($namaUser); ?>"
            placeholder="Masukkan nama Anda" required>

          <label for="barang">Barang yang Kembali / Ditemukan</label>
          <input type="text" name="barang" id="barang" placeholder="Contoh: Dompet, Laptop, Kunci Kendaraan" required>

          <label for="deskripsi">Pesan Testimoni</label>
          <textarea name="deskripsi" id="deskripsi" placeholder="Ceritakan pengalaman Anda memakai platform ini"
            required></textarea>

          <label for="gambar">Gambar Barang / Bukti (Wajib 1 Gambar)</label>
          <input type="file" name="gambar" id="gambar" accept="image/*" required>
          <label for="gambar" class="border_kotak"><span>+</span></label>

          <div id="preview-container" class="preview-container hidden">
            <img id="image-preview" src="" alt="Preview Gambar">
            <button type="button" id="btn-remove" class="btn-remove" title="Hapus Gambar">x</button>
          </div>
          
          <input type="submit" value="KIRIM TESTIMONI">
        </form>
      </div>
    </section>
  </main>

  <footer>
    <p>Copyright &copy; 2026 Yaudah LostnFound</p>
  </footer>

  <script src="../public/js/testimoni.js"></script>
</body>

</html>