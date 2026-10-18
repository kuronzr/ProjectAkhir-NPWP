<?php
require_once '../config/auth.php';
checkAuth();
require_once '../model/testiModel.php';
$testimoniModel = new TestimoniModel();
$listTestimoni = $testimoniModel->getAllTestimoni();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testimoni - Yaudah LostnFound</title>
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
    <section class="testi-head">
      <h2>Testimoni</h2>
      <p>Cerita dari mahasiswa dan dosen yang barangnya kembali lewat Yaudah LostnFound.</p>
    </section>

    <section class="testi-grid">
      <?php if (!empty($listTestimoni)): ?>
        <?php foreach ($listTestimoni as $testi): ?>
          <?php
          $imgSrc = !empty($testi['gambar'])
            ? '../public/uploads/' . $testi['gambar']
            : '../public/gambar/default.jpg';
          ?>
          <article class="testi-card">
            <img src="<?= htmlspecialchars($imgSrc); ?>" alt="Foto Testimoni">
            <div class="testi-body">
              <mark>Barang kembali: <?= htmlspecialchars($testi['barang']); ?></mark>
              <p class="testi-desc"><?= htmlspecialchars($testi['deskripsi']); ?></p>
              <h3><?= htmlspecialchars($testi['nama']); ?></h3>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="grid-column: 1/-1; text-align: center;">Belum ada testimoni. Jadilah yang pertama mengirim testimoni!
        </p>
      <?php endif; ?>
    </section>

    <section class="testi-form-wrap">
      <div class="form-container">
        <h2>Kirim Testimoni</h2>

        <form action="../control/proses_testi.php" method="POST" enctype="multipart/form-data">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>

          <label for="barang">Barang yang Kembali</label>
          <input type="text" name="barang" id="barang" placeholder="Contoh: Dompet, Laptop, Jaket" required>

          <label for="deskripsi">Deskripsi</label>
          <textarea name="deskripsi" id="deskripsi" placeholder="Ceritakan pengalaman Anda memakai website ini"
            required></textarea>

          <label for="gambar">Gambar (Opsional)</label>
          <input type="file" name="gambar" id="gambar" accept="image/*">
          <label for="gambar" class="border_kotak"><span>+</span></label>

          <div id="preview-container" class="preview-container hidden">
            <img id="image-preview" src="" alt="Preview Gambar">
            <button type="button" id="btn-remove" class="btn-remove" title="Hapus Gambar">x</button>
          </div>

          <input type="submit" value="KIRIM">
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