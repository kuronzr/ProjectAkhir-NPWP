<?php
session_start();
require_once '../config/auth.php';
require_once '../model/userModel.php';

checkAuth(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel();
    $userId    = $_SESSION['user']['id'];

    $nama = $_POST['nama'] ?? '';
    $bio  = $_POST['bio'] ?? '';

    $avatarName = null;
    $bannerName = null;

    $targetDir = "../public/uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarName = time() . '_avatar_' . uniqid() . '_' . basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $targetDir . $avatarName);
    }

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $bannerName = time() . '_banner_' . uniqid() . '_' . basename($_FILES['banner']['name']);
        move_uploaded_file($_FILES['banner']['tmp_name'], $targetDir . $bannerName);
    }

    $updated = $userModel->updateProfile($userId, $nama, $bio, $avatarName, $bannerName);

    if ($updated) {
        $_SESSION['user']['nama'] = $nama;
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='../view/profile.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil.'); window.location='../view/profile.php';</script>";
    }
} else {
    header("Location: ../view/profile.php");
    exit();
}
?>