<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/auth.php';
require_once '../model/laporModel.php';

checkAuth();

if (isset($_GET['id']) && isset($_GET['tipe'])) {
    $laporanModel = new LaporanModel();
    $id = $_GET['id'];
    $tipe = $_GET['tipe'];
    $user_id = $_SESSION['user']['id'] ?? 0;

    if ($laporanModel->selesaikanLaporan($id, $tipe, $user_id)) {
        echo "<script>alert('Selamat! Laporan berhasil diselesaikan. Silakan isi testimoni Anda.'); window.location='../view/form_testi.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus laporan. Pastikan Anda adalah pemilik laporan ini.'); window.location='../view/profile.php';</script>";
    }
} else {
    header("Location: ../view/profile.php");
    exit();
}
?>