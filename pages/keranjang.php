<?php
session_start();
include 'koneksi.php';
function hapusProdukDariKeranjang($id)
{
  if (isset($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $key => $item) {
      if ($item['id'] == $id) {
        unset($_SESSION['keranjang'][$key]);
        break;
      }
    }
  }
}

// Proses hapus produk dari keranjang
if (isset($_GET['hapus'])) {
  $id_produk = $_GET['hapus'];
  hapusProdukDariKeranjang($id_produk);
  header('Location: keranjang.php');
  exit();
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

    .search-form input[type="search"] {
      width: 450px;
      height: 28px;
      font-size: 10px;
      margin-top: 5px;
    }

    .search-form button {
      width: 70px;
      height: 28px;
      font-size: 10px;
      border-color: #fff;
      color: #fff;
      margin-top: 5px;

    }

    .breadcrumb {
      margin-top: 70px;
      margin-bottom: 30px;
      font-size: 12px;
      background-color: #fff;
      border-radius: 2px;

    }

    .breadcrumb-row {
      display: flex;
      align-items: center;
    }

    .breadcrumb-row .breadcrumb {
      margin-bottom: 0;
    }
  </style>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="../css/stylecart.css" />
  <title>Krusty Store</title>

  <!--Feather Icon-->
  <script src="https://unpkg.com/feather-icons"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
</head>

<!--Mulai Navbar-->

<body>
  <script src="../js/script.js"></script>

  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../assets/LOGO KRUSTY.png" alt="" width="55" height="55" class="d-inline-block" />
        Krusty<strong>Store</strong>
      </a>

      <div class="d-flex align-items-center">
        <form class="search-form d-flex">
          <input class="form-control me-2" type="search" placeholder="Temukan barang impianmu!" aria-label="Search" />
          <button class="btn btn-light" type="submit">Cari</button>
        </form>
      </div>

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


  <!--Breadcrumbs-->
  <div class="breadcrumb-container">
    <div class="container">
      <div class="breadcrumb-row">
        <nav aria-label="breadcrumb" class="flex-grow-1">
          <ol class="breadcrumb p-2">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!--Breadcrumbs end-->


  <!--Keranjang-->
  <div class="container">
    <div class="row row-product">
      <div class="col-md-12">
        <table class="table">
          <thead class="table-secondary">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Foto Produk</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Harga</th>
              <th scope="col">Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $totalHarga = 0;

            if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) {
              foreach ($_SESSION['keranjang'] as $key => $item) {
                if (array_key_exists('jumlah', $item)) {
                  $jumlah = intval($item['jumlah']);
                } else {
                  $jumlah = 0;
                }
                if (array_key_exists('harga', $item)) {
                  $harga = intval($item['harga']);
                } else {
                  $harga = 0;
                }

            ?>
                <tr>
                  <th scope="row"><?php echo $no; ?></th>
                  <td><?php echo $item['nama']; ?></td>
                  <td>
                    <?php
                    $id_produk = $item['id'];
                    $query = "SELECT foto FROM produk WHERE id_produk = '$id_produk'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $foto = $row['foto'];
                    ?>
                    <img src="../assets/produk/<?php echo $foto; ?>" class="card-img-bottom" alt="Gambar Produk">
                  </td>
                  <td>
                    <input type="number" min="1" max="10" value="<?php echo $jumlah; ?>" onchange="updateQuantity(<?php echo $key; ?>, this.value)">
                  </td>
                  <td><?php echo $harga; ?></td>
                  <td>
                    <a href="keranjang.php?hapus=<?php echo $item['id']; ?>" class="trash-icon" style="margin-left: -55px">
                      <i data-feather="trash-2"></i>
                    </a>
                  </td>
                </tr>
              <?php
                $no++;
                $totalHarga += ($harga * $jumlah);
              }
            } else {
              ?>
              <tr>
                <td colspan="5">Keranjang kosong</td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <h4 id="totalHarga">Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
      </div>

    </div>
  </div>



  <!--Keranjang-->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    feather.replace();
  </script>

  <script>
    function updateQuantity(index, value) {
      $.ajax({
        url: 'updatekeranjang.php',
        type: 'POST',
        data: {
          index: index,
          quantity: value
        },
        success: function(response) {

          window.location.reload();
        }
      });
    }
  </script>





</body>

</html>