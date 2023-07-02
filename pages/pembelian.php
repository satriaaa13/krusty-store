<?php
session_start();
include 'koneksi.php';

$id_produk = $_GET['id'];
$query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  // Proses pembelian produk
  if (isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['opsi-pengiriman']) && isset($_POST['jumlah'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $opsi_pengiriman = $_POST['opsi-pengiriman'];
    $jumlah = $_POST['jumlah'];

    $harga_satuan = $row['harga'];

    // Proses penghitungan subtotal dan total pembayaran
    $tanggal_pembelian = date('Y-m-d');
    $subtotal = $harga_satuan * $jumlah;
    $total = $subtotal + intval($opsi_pengiriman);

    // Tangkap nilai metode pembayaran
    $metode_pembayaran = $_POST['metode-pembayaran'];

    // Simpan data pembelian ke dalam database
    $query_pembelian = "INSERT INTO pembelian (produk_id, nama, jumlah, tanggal_pembelian, total_harga, metode_pembayaran, status_pembayaran) VALUES ('$id_produk', '$nama', '$jumlah', '$tanggal_pembelian', '$total', '$metode_pembayaran', '')";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--FONT-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,400;1,600&display=swap" rel="stylesheet" />

  <style>
    .navbar {
      height: 60px;
      font-size: 12px;
      display: flex;
      align-items: center;
    }
  </style>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="../css/stylebuy.css" />
  <title>Krusty Store</title>

  <!--Feather Icon-->
  <script src="https://unpkg.com/feather-icons"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
</head>

<!--Mulai Navbar-->

<body onload="hideAlert()">
  <script src="../js/logout.js"></script>

  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../assets/LOGO KRUSTY.png" alt="" width="55" height="55" class="d-inline-block" />
        Krusty<strong>Store</strong>
      </a>

      <!--Navbar-nav-->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="beranda.php">Beranda</a>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="logout()">Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row row-product">
      <div class="col-lg-12">
        <h4>Pembayaran</h4>
        <form method="POST" action="pembelian.php?id=<?php echo $row['id_produk']; ?>">
          <div class="form-group">
            <label>Nama Produk</label><br>
            <?php echo $row['nama']; ?>
          </div>
          <div class="form-group">
            <label>Harga</label><br>
            Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?>
          </div>
          <!-- Form pembelian -->
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat Pengiriman</label>
            <input type="text" id="alamat" name="alamat" required>
          </div>
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="you@gmail.com">
            <div class="invalid-feedback">
              Masukkan email yang benar!!
            </div>
          </div>


          <input type="hidden" name="tanggal_pembelian" value="<?php echo date('Y-m-d'); ?>">
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" required>
          </div>



          <div class="form-group">
            <label for="opsi-pengiriman">Opsi Pengiriman</label>
            <select id="opsi-pengiriman" name="opsi-pengiriman">
              <option value="30000">Reguler - Rp30.000 (2-3 Hari)</option>
              <option value="70000">Kargo - Rp70.000 (3-4 hari)</option>
              <option value="15000">Hemat - Rp15.000 (5-6 hari)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="metode-pembayaran">Metode Pembayaran</label>
            <select id="metode-pembayaran" name="metode-pembayaran">
              <option value="BCA">BCA</option>
              <option value="BRI">BRI</option>
              <option value="BNI">BNI</option>
              <option value="MANDIRI">Mandiri</option>
              <option value="GOPAY">GoPay</option>
            </select>
          </div>

          <?php
          // Proses penghitungan subtotal dan total pembayaran
          if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];

            $harga_satuan = $row['harga'];
            $jumlah = $_POST['jumlah'];
            $tanggal_pembelian = $_POST['tanggal_pembelian'];
            $opsi_pengiriman = $_POST['opsi-pengiriman'];
            $subtotal = $harga_satuan * $jumlah;
            $total = $subtotal + intval($opsi_pengiriman);

            // Tangkap nilai metode pembayaran
            $metode_pembayaran = $_POST['metode-pembayaran'];

            // Simpan data pembelian ke dalam database
            $query = "INSERT INTO pembelian (produk_id, nama, jumlah, tanggal_pembelian, total_harga, metode_pembayaran, status_pembayaran) VALUES ('$id_produk', '$nama', '$jumlah', '$tanggal_pembelian', '$total', '$metode_pembayaran', '')";
            $result = mysqli_query($conn, $query);

            if ($result) {
              // Data berhasil disimpan
              $id_pembelian_baru = mysqli_insert_id($conn); // Dapatkan id_pembelian baru

              // Update status_pembayaran menjadi "Terbayar"
              $query_update = "UPDATE pembelian SET status_pembayaran = 'Terbayar' 'belum bayar' WHERE id_pembelian = '$id_pembelian_baru'";
              $result_update = mysqli_query($conn, $query_update);
            } else {
              // Error saat menyimpan data pembelian
              echo "Terjadi kesalahan saat menyimpan data pembelian.";
            }
          }
          ?>

          <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
          <input type="hidden" name="tanggal_pembelian" value="<?php echo date('Y-m-d'); ?>">
          <button type="submit" name="submit" class="btn btn-success">Beli Sekarang</button>


          <!--Modal-->
          <button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#beli"><i class="fa fa-info"></i>Rincian Pembayaran</button>
          <div class="modal fade" id="beli" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body ">
                  <div class="text-right">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                  </div>
                  <div class="px-4 py-5">
                    <h5 class="text-uppercase"><?php echo $nama; ?></h5>
                    <h4 class="mt-5 theme-color mb-5">Terima Kasih Telah Order</h4>
                    <p style="margin-top:-40px; font-weight:200;">Pesanan akan segera kami proses</p>

                    <span class="theme-color">Rincian Pembayaran</span>
                    <div class="mb-3">
                      <hr class="new1">
                    </div>

                    <div class="d-flex justify-content-between">
                      <span class="font-weight-bold">Harga</span>
                      <span class="text-muted">Rp. <?php echo number_format($harga_satuan, 0, ',', '.'); ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                      <small>Jumlah</small>
                      <small><?php echo $jumlah; ?></small>
                    </div>

                    <div class="d-flex justify-content-between">
                      <small>Pengiriman</small>
                      <small>Rp. <?php echo number_format($opsi_pengiriman, 0, ',', '.'); ?></small>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                      <span class="font-weight-bold">Total</span>
                      <span class="font-weight-bold theme-color">Rp. <?php echo number_format($total, 0, ',', '.'); ?></span>
                    </div>

                    <div class="text-center mt-5">
                    <button class="btn btn-primary" onclick="window.location.href = 'beranda.php';">Belanja Lagi</button>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Alert "Pembelian Berhasil!" -->
          <?php
          if (isset($_POST['submit'])) {
            echo '<div id="alert-message" class="alert alert-success" role="alert" style="margin-top: 20px; font-size: 13px; text-align: center;">
                  Pembelian Berhasil
                </div>';
          }
          ?>
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


  <script>
    // Fungsi untuk menghilangkan alert setelah 5 detik
    function hideAlert() {
      setTimeout(function() {
        document.getElementById('alert-message').style.display = 'none';
      }, 5000); // 5000 milidetik = 5 detik
    }
  </script>

</body>

</html>