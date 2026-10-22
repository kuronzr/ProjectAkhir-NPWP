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
    public function tambahKehilangan($user_id, $nama, $kategori, $deskripsi, $tempat, $tanggal, $notelp)
    {
        $user_id = (int) $user_id;
        $nama = mysqli_real_escape_string($this->db, $nama);
        $kategori = mysqli_real_escape_string($this->db, $kategori);
        $deskripsi = mysqli_real_escape_string($this->db, $deskripsi);
        $tempat = mysqli_real_escape_string($this->db, $tempat);
        $tanggal = mysqli_real_escape_string($this->db, $tanggal);
        $notelp = mysqli_real_escape_string($this->db, $notelp);

        $sql = "INSERT INTO laporan_kehilangan (user_id, nama, kategori, deskripsi, tempat, tanggal, notelp) 
            VALUES ('$user_id', '$nama', '$kategori', '$deskripsi', '$tempat', '$tanggal', '$notelp')";

        if (mysqli_query($this->db, $sql)) {
            return mysqli_insert_id($this->db);
        }
        return false;
    }

    // Menyimpan laporan barang ditemukan
    public function tambahMenemukan($user_id, $nama, $kategori, $deskripsi, $tempat, $tanggal, $notelp)
    {
        $user_id = (int) $user_id;
        $nama = mysqli_real_escape_string($this->db, $nama);
        $kategori = mysqli_real_escape_string($this->db, $kategori);
        $deskripsi = mysqli_real_escape_string($this->db, $deskripsi);
        $tempat = mysqli_real_escape_string($this->db, $tempat);
        $tanggal = mysqli_real_escape_string($this->db, $tanggal);
        $notelp = mysqli_real_escape_string($this->db, $notelp);

        $sql = "INSERT INTO laporan_menemukan (user_id, nama, kategori, deskripsi, tempat, tanggal, notelp) 
            VALUES ('$user_id', '$nama', '$kategori', '$deskripsi', '$tempat', '$tanggal', '$notelp')";

        if (mysqli_query($this->db, $sql)) {
            return mysqli_insert_id($this->db);
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
            $sql = "SELECT id, nama, 'Barang Hilang' AS status, deskripsi, tempat, tanggal, created_at, 'kehilangan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_kehilangan $whereKategori";
        } elseif ($filter == 'ditemukan') {
            $sql = "SELECT id, nama, 'Barang Ditemukan' AS status, deskripsi, tempat, tanggal, created_at, 'menemukan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_menemukan $whereKategori";
        } else {
            $sql = "SELECT id, nama, 'Barang Hilang' AS status, deskripsi, tempat, tanggal, created_at, 'kehilangan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_kehilangan $whereKategori
                UNION ALL
                SELECT id, nama, 'Barang Ditemukan' AS status, deskripsi, tempat, tanggal, created_at, 'menemukan' AS tipe, kategori, notelp AS no_hp 
                FROM laporan_menemukan $whereKategori";
        }

        $sql .= " ORDER BY created_at DESC";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Menghapus laporan berdasarkan ID dan tipe
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

    // Ambil semua laporan milik user tertentu berdasarkan user_id
    public function getLaporanByUserId($user_id)
    {
        $user_id = (int) $user_id;

        $sql = "SELECT id, nama, 'Barang Hilang' AS status, deskripsi, tempat, tanggal, created_at, 'kehilangan' AS tipe, kategori, notelp AS no_hp 
            FROM laporan_kehilangan WHERE user_id = '$user_id'
            UNION ALL
            SELECT id, nama, 'Barang Ditemukan' AS status, deskripsi, tempat, tanggal, created_at, 'menemukan' AS tipe, kategori, notelp AS no_hp 
            FROM laporan_menemukan WHERE user_id = '$user_id'
            ORDER BY created_at DESC";

        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Konfirmasi laporan selesai (menghapus laporan dari database)
    public function selesaikanLaporan($id, $tipe, $user_id)
    {
        $id = (int) $id;
        $user_id = (int) $user_id;
        $tipe = strtolower(trim(mysqli_real_escape_string($this->db, $tipe)));

        // Tentukan tabel berdasarkan tipe
        if ($tipe === 'kehilangan' || $tipe === 'hilang') {
            $tabel = 'laporan_kehilangan';
            $tipeGambar = 'kehilangan';
        } else {
            $tabel = 'laporan_menemukan';
            $tipeGambar = 'menemukan';
        }

        // Hapus laporan berdasarkan ID dan user_id pemiliknya
        $sql = "DELETE FROM $tabel WHERE id = '$id' AND user_id = '$user_id'";
        $query = mysqli_query($this->db, $sql);

        if ($query && mysqli_affected_rows($this->db) > 0) {
            // Hapus juga gambar terkait dari tabel gambar_laporan
            $sqlGambar = "DELETE FROM gambar_laporan WHERE laporan_id = '$id' AND tipe_laporan = '$tipeGambar'";
            mysqli_query($this->db, $sqlGambar);
            return true;
        }

        return false;
    }
}

?>