<?php
session_start();
require_once 'koneksi.php';

if (isset($_POST['id'])) {
  $id_produk = $_POST['id'];

  $query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if ($row) {
    $produk = array(
      'id' => $row['id_produk'],
      'nama' => $row['nama'],
      'harga' => $row['harga'],
      'jumlah' => 1
    );

    if (isset($_SESSION['keranjang'])) {
      $index = -1;
      foreach ($_SESSION['keranjang'] as $key => $item) {
        if ($item['id'] == $produk['id']) {
          $index = $key;
          break;
        }
      }

      if ($index != -1) {
       
        $_SESSION['keranjang'][$index]['jumlah'] += 1;
      } else {
        
        array_push($_SESSION['keranjang'], $produk);
      }
    } else {
      $_SESSION['keranjang'] = array($produk);
    }

    header('Location: keranjang.php');
    exit();
  } else {
    echo "Produk tidak ditemukan.";
  }
}
?>
