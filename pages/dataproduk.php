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
    <link rel="stylesheet" type="text/css" href="../css/styledataproduk.css" />


    <title>Krusty Store</title>

    <!--Feather Icon-->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <script src="../js/logout.js"></script>

    <!-- Notifikasi berhasil login -->
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
                        <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Breadcrumbs end-->
    <div class="container">
        <div class="col-lg-10 mx-auto" style="margin-top: 10px;">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table">
                    <tr>
                        <th style="background-color: #ffffff;">No.</th>
                        <th style="background-color: #ffffff;">Nama Barang</th>
                        <th style="background-color: #ffffff;">Harga</th>
                        <th style="background-color: #ffffff;">Stock</th>
                        <th style="background-color: #ffffff;">Gambar</th>
                        <th style="background-color: #ffffff;">Aksi</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM produk";

                    // Menjalankan query
                    $result = mysqli_query($conn, $sql);

                    // Memeriksa apakah ada data hasil query
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        // Menampilkan produk
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_produk = $row['id_produk'];
                            $nama = $row['nama'];
                            $harga = $row['harga'];
                            $stok = $row['ketersediaan_stok'];
                            $gambar = $row['foto'];

                            // Menampilkan data produk dalam elemen HTML
                            echo '<tr>
                            <td style="background-color: #ffffff;">' . $no++ . '</td>
                            <td style="background-color: #ffffff;">' . $nama . '</td>
                            <td style="background-color: #ffffff;">Rp. ' . number_format($harga, 0, ',', '.') . '</td>
                            <td style="background-color: #ffffff;">' . $stok . '</td>
                            <td style="background-color: #ffffff;">
                                <img src="../assets/produk/' . $gambar . '" class="card-img-top" alt="...">
                            </td>
                            <td style="background-color: #ffffff;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit" style="margin-top: auto; color:green;">
                            Edit
                             </button>

                        
                        
                             <button class="btn btn-danger btn-xs" onclick="showEditForm(' . $row['id_produk'] . ')" data-idproduk="' . $row['id_produk'] . '" style="margin-top: auto; color:red;">Hapus</button>
                            
                             </td>
                        </tr>';
                        }
                    } else {
                        echo '<tr>
                            <td colspan="6">Tidak ada produk yang ditemukan.</td>
                        </tr>';
                    }
                    ?>
                </table>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah" style="margin-top: auto; color:green;">
                Tambah Barang
            </button>

            <!-- Modal -->
            <!--Tambah Barang-->
            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambah">Tambahkan Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" action="tambahproduk.php">
                                <div class="form-group">
                                    <label class="control-label" for="nama">Nama Barang</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="harga">Harga</label>
                                    <input type="number" name="harga" class="form-control" id="harga" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="ketersediaan_stok">Stock</label>
                                    <input type="number" name="ketersediaan_stok" class="form-control" id="ketersediaan_stok" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="foto">Gambar</label>
                                    <input type="file" name="foto" class="form-control" id="foto" required>
                                    <!-- Menampilkan gambar setelah diunggah -->
                                    <?php if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) : ?>
                                        <?php $file_tmp = $_FILES['foto']['tmp_name']; ?>
                                        <img src="../assets/img/<?php echo $_FILES['foto']['name']; ?>" alt="Gambar">
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="background-color: red;">Keluar</button>
                                    <button type="submit" class="btn btn-info" style="color: aqua;" name="simpan" value="Simpan">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Edit Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" action="editproduk.php">
                                <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
                                <div class="form-group">
                                    <label class="control-label" for="nama">Nama Barang</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="harga">Harga</label>
                                    <input type="number" name="harga" class="form-control" id="harga" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="ketersediaan_stok">Stock</label>
                                    <input type="number" name="ketersediaan_stok" class="form-control" id="ketersediaan_stok" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="foto">Gambar</label>
                                    <input type="file" name="foto" class="form-control" id="foto" required>
                                    <!-- Menampilkan gambar setelah diunggah -->
                                    <?php if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) : ?>
                                        <?php $file_tmp = $_FILES['foto']['tmp_name']; ?>
                                        <img src="../assets/img/<?php echo $_FILES['foto']['name']; ?>" alt="Gambar">
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="background-color: red;">Keluar</button>
                                    <button type="submit" class="btn btn-info" style="color: aqua;" name="edit" value="Simpan">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                feather.replace();
            </script>
            <script>
                function showEditForm(id_produk) {
                    // Konfirmasi penghapusan
                    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
                        // Mengirim permintaan AJAX ke skrip hapusproduk.php
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "hapusproduk.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Memperbarui tampilan atau memberikan notifikasi setelah penghapusan berhasil
                                alert("Data berhasil dihapus.");
                                // Lakukan pembaruan halaman atau tindakan lain yang diperlukan
                                location.reload();
                            }
                        };
                        xhr.send("id_produk=" + id_produk);
                    }
                }
            </script>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>