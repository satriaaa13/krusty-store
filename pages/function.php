<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menyeleksi data user dengan username dan password
    $login = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        if ($username == 'admin') {
            // Jika input username adalah 'admin', arahkan ke halaman admin.php
            $_SESSION['username'] = $username;
            header("Location: admin.php");
        } else {
            // Jika input username bukan 'admin', arahkan ke halaman beranda.php
            $_SESSION['username'] = $username;
            header("Location: beranda.php");
        }
        exit();
    } else {
        $pesan = "Username atau password salah";
        header("location: index.php?pesan=" . urlencode($pesan));
        exit();
    }
} elseif (isset($_POST['daftar'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "INSERT INTO login (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "<h1>Selamat $username, Pendaftaran berhasil!</h1>";
        echo "<p>Sekarang kamu bisa login dan cari barang impianmu!</p>";
        echo "<a href='index.php'>Kembali ke Halaman Login</a>";
        exit;
    } else {
        echo "Oops, terjadi kesalahan saat melakukan pendaftaran: " . mysqli_error($conn);
    }
}

?>
