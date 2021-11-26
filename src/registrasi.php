<?php
session_start();

if (isset($_SESSION['login'])) :
    header("Location: index.php");
endif;

require('functions.php');
if (isset($_POST['submit'])) :
    if (registrasi($_POST) > 0) :
        echo "
        <script>
            alert('Registrasi berhasil');
            window.location.href = 'login.php';
        </script>
        ";
    else :
        echo "
        <script>
            alert('Registrasi gagal');
            window.location.href = 'registrasi.php';
        </script>
        ";
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/registrasi.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <div class="col-xl-8">
                <div class="con-judul">
                    <h1>Daftar Akun</h1>
                </div>
                <div class="con-inputs">
                    <div class="con-input">
                        <label for="Username">Username</label><br>
                        <input type="text" class="in username mb-4" name="username" placeholder="Username" required>
                        <label for="nama">Nama Lengkap</label><br>
                        <input type="text" class="in nama" name="nama_depan" placeholder="Nama Depan" required>
                        <input type="text" class="in nama" name="nama_belakang" placeholder="Nama Belakang" required><br>
                        <label for="email">E-Mail</label><br>
                        <input type="email" class="in" name="email" placeholder="E-Mail" required><br>
                        <label for="password">Password</label><br>
                        <input type="password" class="in" name="password" placeholder="Password" required><br>
                        <label for="password2">Konfirmasi Password</label><br>
                        <input type="password" class="in" name="password2" placeholder="Konfirmasi Password" required><br>
                        <label for="telepon">Nomor Telepon</label><br>
                        <input type="tel" class="in" name="telepon" placeholder="Nomor Telepon" required><br>
                        <label for="tgl_lahir">Tanggal Lahir</label><br>
                        <input type="date" class="date" name="tgl_lahir" required>
                    </div>
                    <div class="jk">
                        <div class="judul_jk">Jenis Kelamin</div>
                        <div class="jk_pilihan">
                            <div>
                                <input type="radio" name="jk" id="pria" value="Pria" required> Pria
                            </div>
                            <div>
                                <input type="radio" name="jk" id="wanita" value="Wanita"> Wanita
                            </div>
                        </div>
                    </div>
                    <div class="con-input alamat">
                        <label for="alamat">Alamat</label><br>
                        <textarea name="alamat" cols=40></textarea>
                        <button type="submit" name="submit" class="btn btn-primary bottom">Registrasi</button>
                    </div>
                </div>
                <p class="login"><a href="login.php">Log In</a></p>
            </div>
        </div>
    </form>
</body>

</html>