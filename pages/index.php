<?php
session_start();
include 'koneksi.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/stylelogin.css" />


    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet" />

    <!--Feather Icons-->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <a href="#" class="navbar-logo">Krusty<span>Store</span></a>
            <div class="navbar-nav">
                <a href="#about">Tentang Kami</a>
                <a href="#contact">Kontak Kami</a>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <div class="text-sci">
                <h1>Selamat Datang di <br><span>KrustyStore.</span></h1>
                <p>Kami menjamin bahwa mengunjungi website kami lebih menyenangkan daripada,
                    menunggu dia dengan yang lain, disini kamu akan menemukan barang-barang
                    yang bagus dan nyeni,
                    daripada harus menunggu kehadirannya dengan ketidakpastian :(
                    mending All in di KrustyStore daripada All in ke orang yang gak ada rasa Chuakzzzz</p>
            </div>
        </div>
        <div class="logreg-box">
            <div class="form-box login">
                <form method="POST" action="function.php">
                    <h2>Login Dulu</h2>

                    <div class="input-box">
                        <span class="icon"><i data-feather="user"></i></span>
                        <input type="text" id="username" name="username" required>
                        <label>Username</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i data-feather="lock"></i></span>
                        <input type="password" id="password" name="password" required>
                        <label>Password</label>
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox"> Ingat Saya?</label>
                        <a href="#"> Lupa Password?</a>
                    </div>

                    <button class="btn" type="submit" name="login">Login</button>


                    <div class="login-register">
                        <p>Belum punya akun? <a href="daftar.php" class="register-link">Daftar</a></p>
                    </div>
                    <?php
                    if (isset($_GET['pesan'])) {
                        $pesan = $_GET['pesan'];
                        echo "<p class='error'>$pesan</p>";
                    }
                    ?>

                    <div class="alert alert-success mt-4" style="display: none;" id="login-success-alert">
                        Login berhasil!
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    
    <script>
        feather.replace();
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="../js/script.js"></script>
</body>

</html>