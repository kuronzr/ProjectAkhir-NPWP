<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Yaudah LostnFound</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="auth-body">
    <div class="form-container">
        <h2>Buat Akun Baru</h2>

        <form action="../control/proses_veriv.php?action=register" method="POST">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Buat password Anda" required>

            <input type="submit" value="DAFTAR">

            <div class="Registrasi">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </form>
    </div>
</body>

</html>