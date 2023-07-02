<?php
session_start();
include 'koneksi.php';
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
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,400;1,600&display=swap"
      rel="stylesheet"
    />

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
      .breadcrumb{
        margin-top: 70px;
        margin-bottom: 30px;
        font-size: 12px;
        background-color : #fff;
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="../css/styleproduk.css" />
    <title>Krusty Store</title>

    <!--Feather Icon-->
    <script src="https://unpkg.com/feather-icons"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
  </head>

  <!--Mulai Navbar-->
  <body>
  <script src="../js/logout.js"></script>

    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            src="../assets/LOGO KRUSTY.png"
            alt=""
            width="55"
            height="55"
            class="d-inline-block"
          />
          Krusty<strong>Store</strong>
        </a>

        <div class="d-flex align-items-center">
          <form class="search-form d-flex">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Temukan barang impianmu!"
              aria-label="Search"
            />
            <button class="btn btn-light" type="submit">Cari</button>
          </form>
        </div>

        <!--Navbar-nav-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="beranda.php"
                >Beranda</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="keranjang.php">Keranjang</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#" onclick="logout()">Logout</a>
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
          <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Kategori</a></li>
          <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
      </nav>
      </div>
      </div>
      </div>
    <!--Breadcrumbs end-->

      <!--SingleProduk-->
  <div class="container">
  <div class="row row-product">
 
  <?php
$id_produk = $_GET['id'];
// Query untuk mengambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
$result = mysqli_query($conn, $query);
// Periksa apakah data produk ditemukan
if (mysqli_num_rows($result) > 0) {
    // Data produk ditemukan, lakukan pengolahan sesuai kebutuhan (misalnya, tampilkan detail produk)
    $row = mysqli_fetch_assoc($result);

    // Fungsi untuk menambahkan produk ke keranjang
    function tambahProdukKeKeranjang($id, $nama, $harga, $jumlah)
    {
        // Periksa apakah session keranjang sudah ada
        if (isset($_SESSION['keranjang'])) {
            // Periksa apakah produk sudah ada di dalam keranjang
            $index = -1;
            foreach ($_SESSION['keranjang'] as $key => $item) {
                if ($item['id'] == $id) {
                    $index = $key;
                    break;
                }
            }
            if ($index >= 0) {
                // Produk sudah ada di dalam keranjang, tambahkan jumlah produk
                $_SESSION['keranjang'][$index]['jumlah'] += $jumlah;
            } else {
                // Produk belum ada di dalam keranjang, tambahkan produk baru
                $produk = array(
                    'id' => $id,
                    'nama' => $nama,
                    'harga' => $harga,
                    'jumlah' => $jumlah
                );
                $_SESSION['keranjang'][] = $produk;
            }
        } else {
            // Session keranjang belum ada, tambahkan produk baru
            $produk = array(
                'id' => $id,
                'nama' => $nama,
                'harga' => $harga,
                'jumlah' => $jumlah
            );
            $_SESSION['keranjang'][] = $produk;
        }
    }

    // Proses tambah produk ke keranjang
    if (isset($_POST['tambahKeranjang'])) {
        $jumlah_produk = $_POST['jumlahProduk'];
        tambahProdukKeKeranjang($id_produk, $row['nama'], $row['harga'], $jumlah_produk);
        header('Location: keranjang.php');
        exit();
    }
    ?>
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-2">
        <div class="card text-center"> 
        <img src="../assets/produk/<?php echo $row['foto']; ?>" class="card-img-bottom" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                <p class="card-text">Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                <a href="singleproduk.php?id=<?php echo $row['id_produk']; ?>"></a>
            </div>
            
        </div>
    </div>

    <div class="col-lg-7">
  <h4><?php echo $row['nama']; ?></h4>
  <div class="garis-product"></div>
  <img src="../assets/produk/<?php echo $row['foto2']; ?>" class="card-img-kecil" alt="...">

      <h3 id="harga" style ="margin-top : 30px;">Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></h3>
      <form method="POST" action="simpankeranjang.php">
        <input type="hidden" name="id" value="<?php echo $row['id_produk']; ?>">
          <button type="submit" class="btn">
         <svg class="feather" data-feather="shopping-cart"></svg>Simpan Keranjang
            </button>
            <form method="POST" action="pembelian.php?id=<?php echo $row['id_produk']; ?>">
            <a href="pembelian.php?id=<?php echo $row['id_produk']; ?>" class="btn" >Beli Sekarang</a>
        </form>
      
    </div>

    <?php
} else {
    // Data produk tidak ditemukan, berikan pesan atau tindakan yang sesuai
    echo 'Produk tidak ditemukan.';
}
?>      

</div>
</div>

<div class="container" style="margin-top: -55px;">
<div class="row row-product">
  <div class="col-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="deskripsi-tab" data-bs-toggle="tab" data-bs-target="#deskripsi" type="button" role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi Produk</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
    </div>
        <!-- Detail Produk -->
        <div class="detail-produk">
          <div class="detail">
            <p><?php echo $row['detail']; ?></p>
    </div>
  </div>
</div>
</div>
</div>
</div>
     
         


  <!--SingleProduk-->

    <!--Footer-->
    <footer>
      <div class="socials">
        <a href="https://www.instagram.com/satriaaaaaa_13/" target="_blank"><i data-feather="instagram"></i></a>
        <a href="#"><i data-feather="twitter"></i></a>
        <a href="#"><i data-feather="facebook"></i></a>
      </div>
      <div class="credit">
        <a href="#">
          <img
            src="../assets/LOGO KRUSTY.png"
            alt=""
            class="credit-img"
            width="40"
            height="40"
          />
        </a>
        <p style="margin-top: 10px">
          Created by <a href="">Satria Adi Pratama</a> | &copy; 2023
        </p>
      </div>
    </footer>
    <!--Footer End-->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <script>
      feather.replace();
    </script>

  </body>
</html>
