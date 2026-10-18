<?php
require_once '../config/Database.php';

class KeluhanModel
{
    private $db;

    public function __construct()
    {
        global $koneksi;
        $this->db = $koneksi;
    }

    // Menyimpan data keluhan baru ke database
    public function tambahKeluhan($nama, $jenis, $deskripsi)
    {
        $nama = mysqli_real_escape_string($this->db, $nama);
        $jenis = mysqli_real_escape_string($this->db, $jenis);
        $deskripsi = mysqli_real_escape_string($this->db, $deskripsi);

        $sql = "INSERT INTO keluhan (nama, jenis, deskripsi) VALUES ('$nama', '$jenis', '$deskripsi')";
        return mysqli_query($this->db, $sql);
    }

    // Mengambil seluruh daftar keluhan
    public function getAllKeluhan()
    {
        $sql = "SELECT * FROM keluhan ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>