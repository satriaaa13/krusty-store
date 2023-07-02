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
      align-items: left;
    }

    .breadcrumb-row .breadcrumb {
      margin-bottom: 0;
    }
  </style>



  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="../css/stylepesanan.css" />
  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <title>Pesanan</title>


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
            <a class="nav-link active" aria-current="page" href="admin.php">Dashboard</a>
          </li>
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
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!--Breadcrumbs end-->


  <main>
    <div class="container mt-5">
      <div class="d-flex justify-content-center row">
        <div class="col-md-9">
          <div class="rounded">
            <div class="table-responsive table-borderless">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center">
                      <div class="inner-circle"></div>
                    </th>
                    <th>No</th>
                    <th style="text-align: center;">Nama</th>
                    <th>Jumlah</th>
                    <th style="text-align: center;">Total</th>
                    <th>Tanggal Pembelian</th>
                    <th style="text-align: center;">Status</th>
                    <th>Pembayaran</th>
                    <th>Gambar</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="table-body">
                  <?php
                  $query = "SELECT pb.*, pr.foto FROM pembelian pb
                  JOIN produk pr ON pb.produk_id = pr.id_produk";
                  $result = mysqli_query($conn, $query);


                  if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                      $no = 1; // Nomor urut
                      while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr class='cell-1'>";
                        echo "<td class='text-center'><div class='inner-circle'></div></td>";
                        echo "<td>#" . $no . "</td>";
                        echo "<td>" . $row['Nama'] . "</td>";
                        echo "<td style='text-align:center;'>" . $row['Jumlah'] . "</td>";
                        echo "<td style='text-align:center;'>Rp" . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align:center;'>" . $row['tanggal_pembelian'] . "</td>";
                        echo "<td class='status-pembayaran' data-id='" . $row['id_pembelian'] . "'>";
                        echo "<form method='POST' action='statuspembayaran.php'>";
                        echo "<input type='hidden' name='id_pembelian' value='" . $row['id_pembelian'] . "'>";
                        echo "<select name='status_pembayaran' onchange='this.form.submit()'>";
                        echo "<option value='terbayar'" . ($row['status_pembayaran'] == 'terbayar' ? ' selected' : '') . ">Terbayar</option>";
                        echo "<option value='belum_bayar'" . ($row['status_pembayaran'] == 'belum_bayar' ? ' selected' : '') . ">Belum Bayar</option>";
                        echo "</select>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td style='text-align:center;'>" . $row['metode_pembayaran'] . "</td>";
                        echo "<td><img src='../assets/produk/" . $row['foto'] . "' alt='Foto Produk' width='40' height='40'></td>";
                        echo "<td><i class='fa fa-ellipsis-h text-black-50'></i></td>";
                        echo "</tr>";
                        $no++;
                      }
                    } else {
                      echo "<tr><td colspan='9'>Tidak ada data pembelian.</td></tr>";
                    }
                  } else {
                    echo "Terjadi kesalahan dalam menjalankan query: " . mysqli_error($conn);
                  }

                  mysqli_close($conn);
                  ?>

                </tbody>
              </table>
              <button onclick="printTable()" style="border: 1px solid black; background-color: #fff;">
                <i data-feather="printer"></i> Cetak
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    function updateStatusPembayaran(idPembelian, selectedValue) {
      // Kirim permintaan AJAX ke server
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "statuspembayaran.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
            // Perbarui elemen HTML yang sesuai dengan hasil dari server
            var statusPembayaranElem = document.getElementById("status-pembayaran-" + idPembelian);
            if (statusPembayaranElem) {
              statusPembayaranElem.textContent = selectedValue;
            }
          } else {
            console.log("Gagal memperbarui status pembayaran.");
          }
        }
      };
      xhr.send("id_pembelian=" + idPembelian + "&status_pembayaran=" + selectedValue);
    }
  </script>



  <script>
    feather.replace();
  </script>

  <script>
    function printTable() {
      var table = document.querySelector('.table');
      var printWindow = window.open('', '_blank');
      printWindow.document.open();
      printWindow.document.write('<html><head><title>Cetak Tabel</title></head><body>');
      printWindow.document.write('<style>@media print { .table { border-collapse: collapse; width: 100%; } .table td, .table th { border: 1px solid #000; padding: 8px; } .table tr:nth-child(even) { background-color: #f2f2f2; } .table th { padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white; } .table td img { max-width: 100%; height: auto; } }</style>');
      printWindow.document.write('<div class="print-table">' + table.outerHTML + '</div>');
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
      printWindow.close();
    }
  </script>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>