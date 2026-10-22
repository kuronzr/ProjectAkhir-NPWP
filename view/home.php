<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once '../model/laporModel.php';
require_once '../model/gambarModel.php';

// Pengecekan status user & admin
$isLoggedIn = isset($_SESSION['user']);
$userName = $isLoggedIn ? $_SESSION['user']['nama'] : 'Guest';
$isAdmin = $isLoggedIn && isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'admin');

// Ambil filter dan kategori dari URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Inisialisasi Model & Ambil Data Laporan
$laporanModel = new LaporanModel();
$gambarModel = new GambarModel();
$laporanList = $laporanModel->getAllLaporan($filter, $kategori);
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../public/css/style.css" />
  <title>Homepage - Yaudah LostnFound</title>
</head>

<body>
  <header>
    <h1><a href="home.php">Yaudah LostnFound</a></h1>
    <nav>
      <ul>
        <?php if ($isAdmin): ?>
          <!-- HEADER KHUSUS ADMIN -->
          <li><a href="adminkeluh.php">Lihat Keluhan</a></li>
          <li><a href="home.php">Atur Postingan</a></li>
          <li><a href="../control/proses_veriv.php?action=logout"
              onclick="return confirm('Yakin ingin logout?')">Keluar</a></li>

        <?php else: ?>
          <!-- HEADER UNTUK USER BIASA & GUEST -->
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

          <?php if ($isLoggedIn): ?>
            <li><a href="profile.php">Profil Saya</a></li>
            <li><a href="../control/proses_veriv.php?action=logout"
                onclick="return confirm('Yakin ingin logout?')">Keluar</a></li>
          <?php else: ?>
            <li><a href="login.php">Login</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h2>Temukan Kembali Barangmu yang Hilang</h2>
      <p>
        Platform terpadu untuk melaporkan dan menemukan barang hilang di lingkungan kampus.
      </p>

      <?php if (!$isAdmin): ?>
        <a href="form_khilangan.php"><button>+ Laporkan Kehilangan Barang</button></a>
      <?php endif; ?>
    </div>

    <div class="hero-image">
      <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=600&q=80"
        alt="Ilustrasi penemuan barang kampus" />
    </div>
  </section>

  <hr />

  <!-- Kategori Pilihan dengan Filter URL -->
  <section>
    <h3>Kategori Pilihan</h3>
    <ul>
      <li><a href="home.php?kategori=Elektronik">Elektronik (HP/Laptop)</a></li>
      <li><a href="home.php?kategori=Pakaian">Pakaian (Almamater/Kemeja)</a></li>
      <li><a href="home.php?kategori=Perhiasan">Perhiasan (Jam Tangan)</a></li>
      <li><a href="home.php?kategori=Lainnya">Lainnya</a></li>
    </ul>
  </section>

  <hr />

  <section>
    <h2>Laporan Terbaru</h2>

    <?php if ($isLoggedIn): ?>
      <p>
        Filter:
        <a href="home.php?filter=semua<?= !empty($kategori) ? '&kategori=' . urlencode($kategori) : ''; ?>">Semua</a> |
        <a href="home.php?filter=hilang<?= !empty($kategori) ? '&kategori=' . urlencode($kategori) : ''; ?>">Barang
          Hilang</a> |
        <a href="home.php?filter=ditemukan<?= !empty($kategori) ? '&kategori=' . urlencode($kategori) : ''; ?>">Barang
          Ditemukan</a>

        <?php if (!empty($kategori)): ?>
          <br><small>Menampilkan kategori: <strong><?= htmlspecialchars($kategori); ?></strong> (<a href="home.php">Reset
              Kategori</a>)</small>
        <?php endif; ?>
      </p>

      <?php if (!empty($laporanList)): ?>
        <?php foreach ($laporanList as $row): ?>
          <?php
          $semua_gambar = $gambarModel->getAllGambarByLaporan($row['id'], $row['tipe']);
          ?>

          <article style="position: relative; padding-bottom: 20px;">
            <p><strong>Pelapor:</strong> <?= htmlspecialchars($row['nama']); ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($row['status']); ?></p>

            <div style="margin: 10px 0; display: flex; gap: 10px; flex-wrap: wrap;">
              <?php if (!empty($semua_gambar)): ?>
                <?php foreach ($semua_gambar as $g): ?>
                  <img src="../public/uploads/<?= htmlspecialchars($g['nama_file']); ?>" alt="Gambar Barang"
                    class="img-previewable"
                    style="max-width: 120px; height: 120px; object-fit: cover; border-radius: 8px; cursor: pointer;">
                <?php endforeach; ?>
              <?php else: ?>
                <img src="../public/gambar/default.jpg" alt="Gambar Default" style="max-width: 120px; border-radius: 8px;">
              <?php endif; ?>
            </div>

            <h3><?= htmlspecialchars($row['deskripsi']); ?></h3>
            <p>
              Terakhir di <strong><?= htmlspecialchars($row['tempat']); ?></strong> pada tanggal
              <?= date('d M Y', strtotime($row['tanggal'])); ?>.
            </p>

            <!-- Tombol Kontak & Admin -->
            <button type="button" class="btn-kontak" data-nama="<?= htmlspecialchars($row['nama']); ?>"
              data-nohp="<?= htmlspecialchars($row['no_hp'] ?? 'Tidak dicantumkan'); ?>" data-tipe="<?= $row['tipe']; ?>"
              style="background-color: #082f49; color: white; border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-weight: 600;">
              <?= ($row['tipe'] === 'menemukan') ? 'Lihat Detail & Klaim' : 'Hubungi Pelapor'; ?>
            </button>

            <?php if ($isAdmin): ?>
              <a href="../control/proses_hpuslapor.php?id=<?= $row['id']; ?>&tipe=<?= $row['tipe']; ?>"
                onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')" class="btn-hapus-admin">
                Hapus Postingan
              </a>
            <?php endif; ?>
          </article>

          <hr />
        <?php endforeach; ?>

      <?php else: ?>
        <p>Belum ada laporan sesuai filter/kategori yang dipilih.</p>
      <?php endif; ?>

    <?php else: ?>
      <div
        style="text-align: center; padding: 40px 20px; background: #fff; border-radius: 8px; border: 1px solid #cbd5e1; margin-top: 15px;">
        <p style="font-size: 1.1rem; color: #64748b; margin-bottom: 15px;">
          Silakan <strong>Login</strong> terlebih dahulu untuk melihat daftar laporan barang hilang dan ditemukan.
        </p>
        <a href="login.php"
          style="background-color: #082f49; color: #ffffff; padding: 10px 20px; border-radius: 6px; font-weight: 600; text-decoration: none; display: inline-block;">
          Login Sekarang
        </a>
      </div>
    <?php endif; ?>
  </section>

  <!-- Modal Preview Gambar Fullscreen -->
  <div id="imageModal" class="image-viewer-modal hidden">
    <div class="viewer-header">
      <button type="button" class="btn-back-viewer" id="btnBackViewer">&#8592;</button>
      <span class="viewer-filename" id="viewerFilename">preview_gambar.jpg</span>
    </div>
    <div class="viewer-body">
      <img class="viewer-img" id="imgExpanded" alt="Preview Gambar">
    </div>
  </div>

  <!-- Modal Popup Detail Kontak -->
  <div id="contactModal" class="modal-overlay hidden">
    <div class="modal-contact-content">
      <h3 id="modalTitle">Hubungi Pelapor</h3>
      <p id="modalDesc">Silakan hubungi nomor kontak berikut untuk konfirmasi lebih lanjut:</p>

      <div class="modal-contact-box">
        <p><strong>Nama Pelapor:</strong> <span id="modalNama">-</span></p>
        <p style="margin-top: 10px;"><strong>No. WhatsApp / HP:</strong></p>
        <p style="margin-top: 5px;">
          <a id="modalNoHp" href="#" target="_blank">-</a>
        </p>
      </div>

      <button type="button" id="btnCloseContact" class="btn-close-modal">Tutup</button>
    </div>
  </div>

  <footer>
    <p>Copyright &copy; 2026 Yaudah LostnFound</p>
  </footer>

  <script src="../public/js/home.js"></script>
</body>

</html>