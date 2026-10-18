<?php
require_once '../model/testiModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $testimoniModel = new TestimoniModel();

    $nama = $_POST['nama'] ?? '';
    $barang = $_POST['barang'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $gambar = null;

    if (!empty($nama) && !empty($barang) && !empty($deskripsi)) {
        // Proses upload gambar jika ada
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../public/uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_name = time() . '_' . uniqid() . '_' . basename($_FILES['gambar']['name']);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                $gambar = $file_name;
            }
        }

        $simpan = $testimoniModel->tambahTestimoni($nama, $barang, $deskripsi, $gambar);

        if ($simpan) {
            echo "<script>alert('Testimoni berhasil dikirim!'); window.location='../view/testimoni.php';</script>";
        } else {
            echo "<script>alert('Gagal mengirim testimoni.'); window.location='../view/testimoni.php';</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom yang wajib!'); window.location='../view/testimoni.php';</script>";
    }
} else {
    header("Location: ../view/testimoni.php");
    exit();
}
?>