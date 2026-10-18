<?php
require_once '../model/laporModel.php';
require_once '../model/gambarModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $laporanModel = new LaporanModel();
    $gambarModel = new GambarModel();

    $nama = $_POST['nama'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $tempat = $_POST['tempat'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $notelp = $_POST['notelp'] ?? '';

    // 1. Simpan laporan menemukan menggunakan LaporanModel
    $laporan_id = $laporanModel->tambahMenemukan($nama, $kategori, $deskripsi, $tempat, $tanggal, $notelp);

    if ($laporan_id) {
        // 2. Upload file fisik dan simpan referensi nama file via GambarModel
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

        echo "<script>alert('Laporan penemuan berhasil dikirim!'); window.location='../view/form_nemu.html';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan laporan penemuan.'); window.location='../view/form_nemu.html';</script>";
    }
} else {
    header("Location: ../view/form_nemu.php");
    exit();
}
?>