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
    <title>Login - Yaudah LostnFound</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="auth-body">
    <div class="form-container">
        <h2>Yaudah LostnFound</h2>

        <form action="../control/proses_veriv.php?action=login" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required>

            <input type="submit" value="LOGIN">

            <div class="Registrasi">
                <p>Belum punya akun? <a href="regis.php">Daftar di sini</a></p>
            </div>
        </form>
    </div>
</body>

</html>