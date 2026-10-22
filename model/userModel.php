<?php
require_once '../config/Database.php';

class UserModel
{
    private $db;

    public function __construct()
    {
        global $koneksi;
        $this->db = $koneksi;
    }

    // Mendaftarkan user baru
    public function register($nama, $email, $password)
    {
        $nama = mysqli_real_escape_string($this->db, $nama);
        $email = mysqli_real_escape_string($this->db, $email);

        $checkSql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $checkResult = mysqli_query($this->db, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            return false;
        }

        // Hash password demi keamanan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$hashedPassword', 'user')";
        return mysqli_query($this->db, $sql);
    }

    // Verifikasi login user
    public function login($email, $password)
    {
        $email = mysqli_real_escape_string($this->db, $email);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $res = mysqli_query($this->db, $sql);

        if ($user = mysqli_fetch_assoc($res)) {
            if (password_verify($password, $user['password'])) {
                return $user; 
            }
        }
        return false; 
    }

    // Ambil data user lengkap berdasarkan ID
    public function getUserById($id)
    {
        $id = (int) $id;
        $sql = "SELECT id, nama, email, bio, avatar, banner FROM users WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    // Update profil user
    public function updateProfile($id, $nama, $bio, $avatar = null, $banner = null)
    {
        $id = (int) $id;
        $nama = mysqli_real_escape_string($this->db, $nama);
        $bio = mysqli_real_escape_string($this->db, $bio);

        $queryAvatar = $avatar ? ", avatar = '" . mysqli_real_escape_string($this->db, $avatar) . "'" : "";
        $queryBanner = $banner ? ", banner = '" . mysqli_real_escape_string($this->db, $banner) . "'" : "";

        $sql = "UPDATE users SET nama = '$nama', bio = '$bio' $queryAvatar $queryBanner WHERE id = '$id'";
        return mysqli_query($this->db, $sql);
    }
}
?>