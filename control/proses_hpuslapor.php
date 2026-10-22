<?php
require_once '../model/laporModel.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang dapat menghapus postingan.'); window.location='../view/home.php';</script>";
    exit();
}


if (isset($_GET['id']) && isset($_GET['tipe'])) {
    $laporanModel = new LaporanModel();
    $id = $_GET['id'];
    $tipe = $_GET['tipe'];

    if ($laporanModel->hapusLaporan($id, $tipe)) {
        echo "<script>alert('Postingan berhasil dihapus!'); window.location='../view/home.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus postingan.'); window.location='../view/home.php';</script>";
    }
} else {
    header("Location: ../view/home.php");
    exit();
}
?>