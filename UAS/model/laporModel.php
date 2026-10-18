<?php
require_once '../config/Database.php';

class LaporanModel
{
    private $db;

    public function __construct()
    {
        global $koneksi;
        $this->db = $koneksi;
    }

    // Menyimpan laporan barang hilang
    public function tambahKehilangan($nama, $kategori, $deskripsi, $tempat, $tanggal, $notelp)
    {
        $nama = mysqli_real_escape_string($this->db, $nama);
        $kategori = mysqli_real_escape_string($this->db, $kategori);
        $deskripsi = mysqli_real_escape_string($this->db, $deskripsi);
        $tempat = mysqli_real_escape_string($this->db, $tempat);
        $tanggal = mysqli_real_escape_string($this->db, $tanggal);
        $notelp = mysqli_real_escape_string($this->db, $notelp);

        $sql = "INSERT INTO laporan_kehilangan (nama, kategori, deskripsi, tempat, tanggal, notelp) 
                VALUES ('$nama', '$kategori', '$deskripsi', '$tempat', '$tanggal', '$notelp')";

        if (mysqli_query($this->db, $sql)) {
            return mysqli_insert_id($this->db); // Mengembalikan ID laporan yang baru tersimpan
        }
        return false;
    }

    // Menyimpan laporan barang ditemukan
    public function tambahMenemukan($nama, $kategori, $deskripsi, $tempat, $tanggal, $notelp)
    {
        $nama = mysqli_real_escape_string($this->db, $nama);
        $kategori = mysqli_real_escape_string($this->db, $kategori);
        $deskripsi = mysqli_real_escape_string($this->db, $deskripsi);
        $tempat = mysqli_real_escape_string($this->db, $tempat);
        $tanggal = mysqli_real_escape_string($this->db, $tanggal);
        $notelp = mysqli_real_escape_string($this->db, $notelp);

        $sql = "INSERT INTO laporan_menemukan (nama, kategori, deskripsi, tempat, tanggal, notelp) 
                VALUES ('$nama', '$kategori', '$deskripsi', '$tempat', '$tanggal', '$notelp')";

        if (mysqli_query($this->db, $sql)) {
            return mysqli_insert_id($this->db); // Mengembalikan ID laporan
        }
        return false;
    }

    // Mengambil seluruh laporan dengan filter status dan kategori
    public function getAllLaporan($filter = 'semua', $kategori = '')
    {
        $whereKategori = "";
        if (!empty($kategori)) {
            $kategoriClean = mysqli_real_escape_string($this->db, $kategori);
            $whereKategori = " WHERE kategori = '$kategoriClean'";
        }

        if ($filter == 'hilang') {
            $sql = "SELECT id, nama, 'Hilang' AS status, deskripsi, tempat, tanggal, created_at, 'kehilangan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_kehilangan $whereKategori";
        } elseif ($filter == 'ditemukan') {
            $sql = "SELECT id, nama, 'Ditemukan' AS status, deskripsi, tempat, tanggal, created_at, 'menemukan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_menemukan $whereKategori";
        } else {
            $sql = "SELECT id, nama, 'Hilang' AS status, deskripsi, tempat, tanggal, created_at, 'kehilangan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_kehilangan $whereKategori
                UNION ALL
                SELECT id, nama, 'Ditemukan' AS status, deskripsi, tempat, tanggal, created_at, 'menemukan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_menemukan $whereKategori";
        }

        $sql .= " ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Tambahkan metode ini di dalam kelas LaporanModel
    public function hapusLaporan($id, $tipe)
    {
        $id = (int) $id;
        $tipe = mysqli_real_escape_string($this->db, $tipe);

        if ($tipe === 'kehilangan') {
            $sql = "DELETE FROM laporan_kehilangan WHERE id = '$id'";
        } else {
            $sql = "DELETE FROM laporan_menemukan WHERE id = '$id'";
        }

        if (mysqli_query($this->db, $sql)) {
            $sqlGambar = "DELETE FROM gambar_laporan WHERE laporan_id = '$id' AND tipe_laporan = '$tipe'";
            mysqli_query($this->db, $sqlGambar);
            return true;
        }
        return false;
    }
}

?>