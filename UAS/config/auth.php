<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fungsi untuk mengecek apakah pengguna sudah login
function checkAuth()
{
    if (!isset($_SESSION['user'])) {
        echo "<script>
            alert('Silakan login terlebih dahulu untuk mengakses fitur ini!');
            window.location.href = '../view/login.php';
        </script>";
        exit();
    }
}
?>