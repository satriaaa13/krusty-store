<?php
include 'koneksi.php';

if (isset($_POST['edit'])) {
    $id_produk = $_POST['id_produk'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['ketersediaan_stok'];
   
    // Mendapatkan informasi file yang diunggah
    $file_name = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    // Tentukan direktori tujuan untuk menyimpan file
    $target_dir = "../assets/produk/";
    $target_file = $target_dir . $file_name;

    // Pindahkan file yang diunggah ke direktori tujuan
    if (move_uploaded_file($file_tmp, $target_file)) {
        // Perbarui nilai $foto sebelum menjalankan kueri SQL
        $foto = $file_name;

        // Proses pembaruan data ke dalam tabel "produk"
        $sql = "UPDATE produk SET nama='$nama', harga='$harga', ketersediaan_stok='$stok', foto='$foto' WHERE id_produk='$id_produk'";
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil diperbarui";
            header("Location: dataproduk.php");
            exit();
        } else {
            echo "Terjadi kesalahan: " . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
}
?>
