<?php
require_once '../config/Database.php';

class TestimoniModel
{
    private $db;

    public function __construct()
    {
        global $koneksi;
        $this->db = $koneksi;
    }

    public function tambahTestimoni($nama, $barang, $pesan, $gambar = null)
    {
        $nama = mysqli_real_escape_string($this->db, $nama);
        $barang = mysqli_real_escape_string($this->db, $barang);
        $pesan = mysqli_real_escape_string($this->db, $pesan);
        $gambar = $gambar ? "'" . mysqli_real_escape_string($this->db, $gambar) . "'" : "NULL";

        $sql = "INSERT INTO testimoni (nama, barang, pesan, gambar) 
                VALUES ('$nama', '$barang', '$pesan', $gambar)";

        return mysqli_query($this->db, $sql);
    }

    public function getAllTestimoni()
    {
        $sql = "SELECT * FROM testimoni ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>