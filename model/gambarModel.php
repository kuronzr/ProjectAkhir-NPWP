<?php
require_once '../config/Database.php';

class GambarModel
{
    private $db;

    public function __construct()
    {
        global $koneksi;
        $this->db = $koneksi;
    }

    // Menyimpan data nama file gambar laporan ke database
    public function tambahGambar($tipe_laporan, $laporan_id, $nama_file)
    {
        $tipe_laporan = mysqli_real_escape_string($this->db, $tipe_laporan);
        $laporan_id = (int) $laporan_id;
        $nama_file = mysqli_real_escape_string($this->db, $nama_file);

        $sql = "INSERT INTO gambar_laporan (tipe_laporan, laporan_id, nama_file) 
                VALUES ('$tipe_laporan', '$laporan_id', '$nama_file')";
        return mysqli_query($this->db, $sql);
    }

    public function getGambarUtama($laporan_id, $tipe_laporan)
    {
        $laporan_id = (int) $laporan_id;
        $tipe_laporan = mysqli_real_escape_string($this->db, $tipe_laporan);

        $sql = "SELECT nama_file FROM gambar_laporan 
                WHERE laporan_id = '$laporan_id' AND tipe_laporan = '$tipe_laporan' 
                LIMIT 1";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    // Ambil SEMUA gambar milik laporan
    public function getAllGambarByLaporan($laporan_id, $tipe_laporan)
    {
        $laporan_id = (int) $laporan_id;
        $tipe_laporan = mysqli_real_escape_string($this->db, $tipe_laporan);

        $sql = "SELECT nama_file FROM gambar_laporan 
                WHERE laporan_id = '$laporan_id' AND tipe_laporan = '$tipe_laporan'";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}
?>