<?php
require_once '../config/auth.php';
require_once '../model/userModel.php';
require_once '../model/laporModel.php';
require_once '../model/gambarModel.php';

checkAuth();

$userId    = $_SESSION['user']['id'];
$userModel = new UserModel();
$userData  = $userModel->getUserById($userId);

$nama   = htmlspecialchars($userData['nama'] ?? 'Pengguna');
$bio    = htmlspecialchars($userData['bio'] ?? 'Belum ada deskripsi profil.');
$avatar = !empty($userData['avatar']) ? '../public/uploads/' . htmlspecialchars($userData['avatar']) : '';
$banner = !empty($userData['banner']) ? '../public/uploads/' . htmlspecialchars($userData['banner']) : '';

$laporanModel = new LaporanModel();
$gambarModel  = new GambarModel();
$myPostings   = $laporanModel->getLaporanByUserId($userId);
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya - Yaudah LostnFound</title>
    <link rel="stylesheet" href="../public/css/style.css" />
  </head>

  <body>
    <!-- Kumpulan Ikon SVG -->
    <svg width="0" height="0" style="position: absolute" aria-hidden="true">
      <defs>
        <symbol id="icon-user" viewBox="0 0 512 512">
          <circle cx="256" cy="128" r="128" fill="currentColor" />
          <path fill="currentColor" d="M64 480C64 380 150 298 256 298C362 298 448 380 448 480A32 32 0 0 1 416 512H96A32 32 0 0 1 64 480Z" />
        </symbol>
        <symbol id="icon-edit" viewBox="0 0 512 512">
          <path d="M234 108H84Q22 108 22 170V428Q22 490 84 490H344Q406 490 406 428V278" fill="none" stroke="currentColor" stroke-width="42" stroke-linecap="round" stroke-linejoin="round" />
          <path fill="currentColor" d="M198 238L368 68L444 144L272 316L192 330Q180 332 182 320Z" />
          <path fill="currentColor" d="M392 44L428 10Q455 -5 482 14L497 28Q514 55 496 80L468 120Z" />
        </symbol>
        <symbol id="icon-remove" viewBox="0 0 512 512">
          <circle cx="256" cy="256" r="241" fill="none" stroke="currentColor" stroke-width="30" />
          <path d="M175 175L337 337M337 175L175 337" fill="none" stroke="currentColor" stroke-width="36" stroke-linecap="round" />
        </symbol>
        <symbol id="icon-camera-plus" viewBox="0 0 512 512">
          <g fill="none" stroke="currentColor" stroke-width="40" stroke-linecap="round" stroke-linejoin="round">
            <path d="M306 80H198Q182 80 174 94L150 135Q144 144 130 144H88Q48 144 48 184V400Q48 443 90 443H428Q468 443 468 400V222" />
            <circle cx="256" cy="282" r="81" />
            <path d="M428 72V148M390 110H466" />
          </g>
        </symbol>
      </defs>
    </svg>

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
          <li><a href="../control/proses_veriv.php?action=logout" onclick="return confirm('Yakin ingin logout?')">Keluar</a></li>
        </ul>
      </nav>
    </header>

    <!-- Kartu Utama Profil -->
    <main class="profile-card">
      <div class="profile-banner" id="profile-banner" style="<?= !empty($banner) ? "background-image: url('$banner'); background-size: cover; background-position: center;" : ''; ?>"></div>

      <div class="profile-body">
        <div class="profile-header-top">
          <div class="profile-avatar" id="profile-avatar">
            <svg class="avatar-default <?= !empty($avatar) ? 'hidden' : ''; ?>" aria-label="Foto profil" role="img">
              <use href="#icon-user" />
            </svg>
            <img class="avatar-img <?= !empty($avatar) ? '' : 'hidden'; ?>" id="profile-avatar-img" src="<?= $avatar; ?>" alt="Foto profil" />
          </div>

          <button type="button" class="btn-edit" id="btn-open-edit">Edit Profile</button>
        </div>

        <h2 class="profile-name" id="profile-name"><?= $nama; ?></h2>
        <p class="profile-desc" id="profile-desc"><?= $bio; ?></p>
      </div>
    </main>

    <!-- Section Daftar Postingan Saya -->
    <section style="max-width: 800px; margin: 30px auto; padding: 0 20px;">
      <h3 style="color: #082f49; border-bottom: 2px solid #082f49; padding-bottom: 8px; margin-bottom: 20px;">
        Postingan Saya
      </h3>

      <?php if (!empty($myPostings)): ?>
        <?php foreach ($myPostings as $row): ?>
          <?php
          $semua_gambar = $gambarModel->getAllGambarByLaporan($row['id'], $row['tipe']);
          ?>

          <article style="background: #fff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 20px; margin-bottom: 20px; position: relative;">
            <p style="margin-bottom: 5px;">
              <strong>Status Laporan:</strong> 
              <mark style="background: #ffd500; color: #082f49; font-weight: bold; padding: 2px 8px; border-radius: 4px;">
                <?= ($row['tipe'] === 'kehilangan') ? 'Barang Hilang' : 'Barang Ditemukan'; ?>
              </mark>
            </p>

            <!-- Tampilkan Gambar -->
            <div style="margin: 10px 0; display: flex; gap: 10px; flex-wrap: wrap;">
              <?php if (!empty($semua_gambar)): ?>
                <?php foreach ($semua_gambar as $g): ?>
                  <img src="../public/uploads/<?= htmlspecialchars($g['nama_file']); ?>" 
                       alt="Gambar Barang" 
                       style="max-width: 100px; height: 100px; object-fit: cover; border-radius: 6px;">
                <?php endforeach; ?>
              <?php else: ?>
                <img src="../public/gambar/default.jpg" alt="Default" style="max-width: 100px; border-radius: 6px;">
              <?php endif; ?>
            </div>

            <h4 style="margin: 10px 0 5px 0; font-size: 1.1rem; color: #1e293b;"><?= htmlspecialchars($row['deskripsi']); ?></h4>
            <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 15px;">
              Terakhir di <strong><?= htmlspecialchars($row['tempat']); ?></strong> pada tanggal <?= date('d M Y', strtotime($row['tanggal'])); ?>.
            </p>

            <!-- Tombol Konfirmasi Selesai -->
            <a href="../control/proses_slesaiLapor.php?id=<?= $row['id']; ?>&tipe=<?= $row['tipe']; ?>" 
               onclick="return confirm('Apakah barang ini sudah kembali/selesai ditangani? Laporan akan dihapus dari beranda.')"
               style="display: inline-block; background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.88rem;">
               &#10004; Konfirmasi Selesai
            </a>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="text-align: center; color: #64748b; background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #e2e8f0;">
          Anda belum pernah membuat laporan kehilangan atau penemuan barang.
        </p>
      <?php endif; ?>
    </section>

    <!-- Modal Popup Edit Profile -->
    <div class="modal-overlay hidden" id="modal-overlay">
      <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <h2 id="modal-title" class="sr-only">Edit Profile</h2>

        <form id="edit-form" class="modal-form" action="../control/proses_profil.php" method="POST" enctype="multipart/form-data">
          <!-- Area Banner dalam Modal -->
          <div class="modal-banner" id="modal-banner" style="<?= !empty($banner) ? "background-image: url('$banner'); background-size: cover; background-position: center;" : ''; ?>">
            <input type="file" id="banner-input" name="banner" accept="image/*" hidden />
            <div class="banner-actions">
              <label for="banner-input" class="banner-btn" title="Tambah / ganti banner">
                <svg aria-hidden="true"><use href="#icon-edit" /></svg>
              </label>
              <button type="button" class="banner-btn" id="btn-remove-banner" title="Hapus banner">
                <svg aria-hidden="true"><use href="#icon-remove" /></svg>
              </button>
            </div>
          </div>

          <!-- Area Avatar dalam Modal -->
          <div class="modal-avatar">
            <input type="file" id="avatar-input" name="avatar" accept="image/*" hidden />
            <svg class="avatar-default <?= !empty($avatar) ? 'hidden' : ''; ?>" id="modal-avatar-default" aria-hidden="true">
              <use href="#icon-user" />
            </svg>
            <img class="avatar-img <?= !empty($avatar) ? '' : 'hidden'; ?>" id="modal-avatar-img" src="<?= $avatar; ?>" alt="Preview foto profil" />

            <label for="avatar-input" class="avatar-cam" title="Ganti foto profil">
              <svg aria-hidden="true"><use href="#icon-camera-plus" /></svg>
            </label>
          </div>

          <!-- Form Isian Nama & Bio -->
          <input type="text" id="edit-name" name="nama" value="<?= $nama; ?>" placeholder="Nama Lengkap" required />
          <textarea id="edit-bio" name="bio" placeholder="Bio" rows="4"><?= $bio; ?></textarea>

          <div class="modal-footer">
            <button type="submit" class="btn-confirm">Confirm</button>
          </div>
        </form>
      </div>
    </div>

    <script src="../public/js/profile.js"></script>
  </body>
</html>