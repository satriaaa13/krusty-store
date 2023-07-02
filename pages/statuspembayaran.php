<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedValue = $_POST['status_pembayaran'];
    $idPembelian = $_POST['id_pembelian'];

    // Perbarui nilai 'status_pembayaran' dalam tabel database
    $queryUpdate = "UPDATE pembelian SET status_pembayaran = ? WHERE id_pembelian = ?";
    $stmt = mysqli_prepare($conn, $queryUpdate);
    mysqli_stmt_bind_param($stmt, 'si', $selectedValue, $idPembelian);
    $resultUpdate = mysqli_stmt_execute($stmt);
    if (!$resultUpdate) {
        die("Gagal memperbarui nilai: " . mysqli_error($conn));
    }
    header("Location: adminpesanan.php");
    exit;
}

?>
