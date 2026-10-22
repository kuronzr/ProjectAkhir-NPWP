<?php
session_start();
require_once '../model/laporModel.php';
require_once '../model/gambarModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $laporanModel = new LaporanModel();
    $gambarModel = new GambarModel();
    $user_id = $_SESSION['user']['id'] ?? NULL;
    $nama = $_POST['nama'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $tempat = $_POST['tempat'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $notelp = $_POST['notelp'] ?? '';
    $laporan_id = $laporanModel->tambahMenemukan($user_id, $nama, $kategori, $deskripsi, $tempat, $tanggal, $notelp);

    if ($laporan_id) {
        // Upload file gambar
        if (isset($_FILES['gambar']) && !empty($_FILES['gambar']['name'][0])) {
            $target_dir = "../public/uploads/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            foreach ($_FILES['gambar']['name'] as $key => $val) {
                if ($_FILES['gambar']['error'][$key] === UPLOAD_ERR_OK) {
                    $file_name = time() . '_' . uniqid() . '_' . basename($_FILES['gambar']['name'][$key]);
                    $target_file = $target_dir . $file_name;

                    if (move_uploaded_file($_FILES['gambar']['tmp_name'][$key], $target_file)) {
                        $gambarModel->tambahGambar('menemukan', $laporan_id, $file_name);
                    }
                }
            }
        }

        echo "<script>alert('Laporan penemuan berhasil dikirim!'); window.location='../view/home.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim laporan penemuan.'); window.location='../view/form_nemu.php';</script>";
    }
} else {
    header("Location: ../view/form_nemu.php");
    exit();
}
?>