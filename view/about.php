<?php
require_once '../config/auth.php';
checkAuth(); // Jika Guest mencoba masuk, akan langsung dialihkan ke login.php
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - Yaudah LostnFound</title>
  <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>

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

    <main class="about">
      <section class="about-text">
        <h2>Yaudah LostnFound</h2>
        <p>
          Website ini dibuat untuk menampung barang kehilangan di kampus, mulai dari mahasiswa hingga dosen.
        </p>
      </section>

      <div class="about-logo">
        <img src="../public/gambar/logo.png" alt="Logo Lost &amp; Found">
      </div>
    </main>

    <section class="faq" id="faq">
      <h2>FAQ</h2>

      <div class="faq-item">
        <button type="button" class="faq-q" aria-expanded="false" aria-controls="faq-2">
          <span>Bagaimana cara melaporkan barang yang hilang?</span>
          <i class="chevron" aria-hidden="true"></i>
        </button>
        <div class="faq-a" id="faq-2">
          <div class="faq-a-inner">
            <p>Buka menu <strong>Laporkan Barang</strong>, lalu pilih <strong>Laporan Kehilangan</strong>. Isi nama,
              kategori, deskripsi barang, tempat dan tanggal terakhir dilihat, serta nomor telepon yang bisa dihubungi.
              Unggah minimal 3 gambar barangmu (atau foto yang mirip), lalu klik <strong>KIRIM</strong>.</p>
          </div>
        </div>
      </div>

      <div class="faq-item">
        <button type="button" class="faq-q" aria-expanded="false" aria-controls="faq-3">
          <span>Bagaimana cara melaporkan barang yang saya temukan?</span>
          <i class="chevron" aria-hidden="true"></i>
        </button>
        <div class="faq-a" id="faq-3">
          <div class="faq-a-inner">
            <p>Buka menu <strong>Laporkan Barang</strong>, lalu pilih <strong>Laporan Menemukan</strong>. Isi data
              barang, tempat dan tanggal ditemukan, serta nomor teleponmu, kemudian unggah minimal 3 gambar barang
              tersebut dan klik <strong>KIRIM</strong>. Simpan barangnya dengan aman sampai pemiliknya menghubungimu.
            </p>
          </div>
        </div>
      </div>

      <div class="faq-item">
        <button type="button" class="faq-q" aria-expanded="false" aria-controls="faq-4">
          <span>Bagaimana cara mengambil barang yang sudah ditemukan?</span>
          <i class="chevron" aria-hidden="true"></i>
        </button>
        <div class="faq-a" id="faq-4">
          <div class="faq-a-inner">
            <p>Cari barangmu di halaman Beranda, lalu hubungi penemunya lewat nomor telepon yang tercantum pada laporan.
              Atur waktu dan tempat pertemuan di area kampus yang ramai, dan bawa kartu identitas (KTM atau KTP) saat
              mengambil barang.</p>
          </div>
        </div>
      </div>

      <div class="faq-item">
        <button type="button" class="faq-q" aria-expanded="false" aria-controls="faq-5">
          <span>Bagaimana cara membuktikan bahwa barang itu milik saya?</span>
          <i class="chevron" aria-hidden="true"></i>
        </button>
        <div class="faq-a" id="faq-5">
          <div class="faq-a-inner">
            <p>Sebutkan ciri khusus barang yang tidak terlihat di foto, misalnya isi dompet, goresan, stiker, wallpaper,
              atau nomor seri. Kamu juga bisa menunjukkan bukti pendukung seperti foto lama barang tersebut, struk
              pembelian, atau kotak kemasannya. Penemu berhak menolak menyerahkan barang jika bukti belum meyakinkan.
            </p>
          </div>
        </div>
      </div>
      </div>
    </section>

    <footer class="footer">
      <p>Copyright &copy; 2026 YaudahLostnFound. All rights reserved.</p>
    </footer>

    <script src="../public/js/about.js"></script>
  </body>

</html>