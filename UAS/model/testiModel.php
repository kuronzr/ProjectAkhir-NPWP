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

    // Mengambil seluruh data testimoni dari database
    public function getAllTestimoni()
    {
        $sql = "SELECT * FROM testimoni ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Menyimpan testimoni baru ke database
    public function tambahTestimoni($nama, $barang, $deskripsi, $gambar = null)
    {
        $nama = mysqli_real_escape_string($this->db, $nama);
        $barang = mysqli_real_escape_string($this->db, $barang);
        $deskripsi = mysqli_real_escape_string($this->db, $deskripsi);
        $gambar = $gambar ? mysqli_real_escape_string($this->db, $gambar) : NULL;

        if ($gambar) {
            $sql = "INSERT INTO testimoni (nama, barang, deskripsi, gambar) 
                    VALUES ('$nama', '$barang', '$deskripsi', '$gambar')";
        } else {
            $sql = "INSERT INTO testimoni (nama, barang, deskripsi) 
                    VALUES ('$nama', '$barang', '$deskripsi')";
        }

        return mysqli_query($this->db, $sql);
    }
}
?>