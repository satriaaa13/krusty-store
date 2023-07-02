<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
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

        // Proses penyimpanan data ke dalam tabel "produk"
        $sql = "INSERT INTO produk (nama, harga, ketersediaan_stok, foto) VALUES ('$nama', '$harga', '$stok', '$foto')";
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan";
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
