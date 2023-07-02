<?php
session_start();
include 'koneksi.php';

// Memeriksa apakah parameter id_produk telah diterima
if (isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];

    // Query untuk menghapus data berdasarkan id_produk
    $sql = "DELETE FROM produk WHERE id_produk = '$id_produk'";

    // Menjalankan query
    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "Parameter id_produk tidak ditemukan.";
}
?>

