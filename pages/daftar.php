<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet" />
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" type="text/css" href="../css/styleregister.css">
</head>
<body>
    <div class="login-register">
        <div class="form-register">
            <h2>Isi Pendaftaran</h2>

            <form method="POST" action="function.php">
                <label for="username">Nama:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" name="daftar">Daftar</button>
            </form>
        </div>
    </div>

</body>
</html>
