<?php
require_once '../model/keluhanModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keluhanModel = new KeluhanModel();
    $nama = $_POST['nama'] ?? '';
    $jenis = $_POST['jenis'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';

    if (!empty($nama) && !empty($jenis) && !empty($deskripsi)) {
        $simpan = $keluhanModel->tambahKeluhan($nama, $jenis, $deskripsi);

        if ($simpan) {
            echo "<script>alert('Keluhan berhasil dikirim!'); window.location='../view/form_keluhan.php';</script>";
        } else {
            echo "<script>alert('Gagal mengirim keluhan'); window.location='../view/form_keluhan.php';</script>";
        }
    } else {
        echo "<script>alert('Harap lengkapi formnya!'); window.location='../view/form_keluhan.php';</script>";
    }
} else {
    header("Location: ../view/form_keluhan.php");
    exit();
}
?>