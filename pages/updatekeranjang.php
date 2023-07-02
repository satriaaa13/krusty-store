<?php
session_start();

if (isset($_POST['index']) && isset($_POST['quantity'])) {
  $index = $_POST['index'];
  $quantity = $_POST['quantity'];

  if (isset($_SESSION['keranjang'][$index])) {
    $_SESSION['keranjang'][$index]['jumlah'] = $quantity;
  }
}
?>
