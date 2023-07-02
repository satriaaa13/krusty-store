<?php
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
  </style>



  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="../css/styleadmin.css" />
  <title>Krusty Store</title>

  <!--Feather Icon-->
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<!--Mulai Navbar-->

<body>
<script src="../js/logout.js"></script>

  <!-- Notfikasi berhasil login -->
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
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dataproduk.php">Data Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminpesanan.php">Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="logout()">Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Carousel-->
  <div class="container">
    <div id="carouseslExampleControls" class="carousel slide mt-auto" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../assets/Adidas.png" class="d-block" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="../assets/headset.png" class="d-block" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="../assets/air jordan.png" class="d-block" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="../assets/kemeja dan sepatu.png" class="d-block" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="../assets/kaos.png" class="d-block" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="../assets/converse.jpg" class="d-block" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Selanjutnya</span>
      </button>
    </div>
  </div>

  

  <!--Footer-->
  <footer>
    <div class="socials">
      <a href="https://www.instagram.com/satriaaaaaa_13/" target="_blank"><i data-feather="instagram"></i></a>
      <a href="#"><i data-feather="twitter"></i></a>
      <a href="#"><i data-feather="facebook"></i></a>
    </div>
    <div class="credit">
      <a href="#">
        <img src="../assets/LOGO KRUSTY.png" alt="" class="credit-img" width="40" height="40" />
      </a>
      <p style="margin-top: 10px">
        Created by <a href="">Satria Adi Pratama</a> | &copy; 2023
      </p>
    </div>
  </footer>
  <!--Foooter End-->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    feather.replace();
  </script>

</body>

</html>