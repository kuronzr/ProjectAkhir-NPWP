<?php
session_start();
require_once '../model/userModel.php';

$userModel = new UserModel();
$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'register') {
        $nama = $_POST['nama'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!empty($nama) && !empty($email) && !empty($password)) {
            if ($userModel->register($nama, $email, $password)) {
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='../view/login.php';</script>";
            } else {
                echo "<script>alert('Registrasi gagal. Email mungkin sudah terdaftar.'); window.location='../view/form_registrasi.php';</script>";
            }
        }
    } elseif ($action === 'login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $userModel->login($email, $password);

        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            echo "<script>alert('Selamat datang, " . $user['nama'] . "!'); window.location='../view/home.php';</script>";
        } else {
            echo "<script>alert('Email atau Password salah!'); window.location='../view/login.php';</script>";
        }
    }
}

if ($action === 'logout') {
    session_destroy();
    header("Location: ../view/home.php");
    exit();
}
?>