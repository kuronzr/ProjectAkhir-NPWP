<?php
session_start();
require_once '../model/keluhanModel.php';

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Halaman ini khusus untuk Admin.'); window.location='home.php';</script>";
    exit();
}

$keluhanModel = new KeluhanModel();
$listKeluhan  = $keluhanModel->getAllKeluhan();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Keluhan - Admin Yaudah LostnFound</title>
  <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
  <header>
    <h1><a href="home.php">Yaudah LostnFound</a></h1>
    <nav>
      <ul>
        <li><a href="adminkeluh.php">Lihat Keluhan</a></li>
        <li><a href="home.php">Atur Postingan</a></li>
        <li><a href="../control/proses_veriv.php?action=logout" onclick="return confirm('Yakin ingin logout?')">Keluar</a></li>
      </ul>
    </nav>
  </header>

  <main class="admin-keluhan-container">
    <h2>Daftar Keluhan Pengguna</h2>
    <p style="color: #64748b;">Keluhan dan masukan yang masuk dari formulir Customer Service.</p>

    <div class="table-admin-wrap">
      <?php if (!empty($listKeluhan)): ?>
        <table class="table-keluhan">
          <thead>
            <tr>
              <th class="col-no">No</th>
              <th class="col-nama">Nama</th>
              <th class="col-jenis">Jenis Keluhan</th>
              <th>Deskripsi</th>
              <th class="col-tgl">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($listKeluhan as $k): ?>
              <tr>
                <td class="col-no"><?= $no++; ?></td>
                <td class="col-nama"><?= htmlspecialchars($k['nama']); ?></td>
                <td class="col-jenis">
                  <span class="badge-jenis"><?= htmlspecialchars($k['jenis']); ?></span>
                </td>
                <td><?= nl2br(htmlspecialchars($k['deskripsi'])); ?></td>
                <td class="col-tgl"><?= date('d M Y H:i', strtotime($k['created_at'])); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p style="padding: 20px; text-align: center; color: #64748b;">Belum ada keluhan yang masuk.</p>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <p>Copyright &copy; 2026 Yaudah LostnFound</p>
  </footer>
</body>
</html>