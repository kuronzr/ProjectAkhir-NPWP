<?php
session_start();
require_once '../model/testiModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $barang = $_POST['barang'] ?? '';
    $pesan = $_POST['deskripsi'] ?? '';
    $gambarNama = null;

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../public/uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . '_' . uniqid() . '_' . basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $gambarNama = $file_name;
        }
    } else {
        echo "<script>alert('Masukin min 1 gambar'); window.history.back();</script>";
        exit();
    }

    $testimoniModel = new TestimoniModel();
    if ($testimoniModel->tambahTestimoni($nama, $barang, $pesan, $gambarNama)) {
        echo "<script>alert('Terima kasih! Testimoni Anda berhasil dikirim.'); window.location='../view/testimoni.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim testimoni.'); window.history.back();</script>";
    }
} else {
    header("Location: ../view/form_testi.php");
    exit();
}
?>