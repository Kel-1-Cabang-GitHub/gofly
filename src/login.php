<?php
session_start();
require('functions.php');

if(isset($_SESSION['login'])):
    header("Location: index.php");
endif;

// if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) :
//     $id = $_COOKIE['id'];
//     $key = $_COOKIE['key'];

//     $result = mysqli_query($conn, "SELECT username FROM user WHERE user_id = '$id';");
//     $row = mysqli_fetch_assoc($result);
//     if ($key === hash('sha256', $row['username'])) :
//         $_SESSION['login'] = $row['username'];
//     endif;
// endif;

if (isset($_POST['login'])) :
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username';");
    if (mysqli_num_rows($result)) :
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) :
            $_SESSION['login'] = $row['username'];

            if (isset($_POST['remember'])) :
                setcookie('id', $row['user_id'], time() + 3600);
                setcookie('key', hash('sha256', $row['username']), time() + 3600);
            endif;

            header('Location: index.php');
            exit;
        endif;
    endif;
    $error = true;
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
</head>

<body>
    <div class="container-fluid">
        <div class="logo">
            <img src="../assets/img/go-fly.png" alt="">
        </div>
        <div class="container">
            <div class="logo"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 kiri">
                    <h1>Kelebihan Web</h1><br>
                    <ul>
                        <li>
                            <p>Pesan lebih cepat. Cukup dengan satu klik untuk lengkapi detail penumpang.</p><br>
                        </li>
                        <li>
                            <p>Atasi semua pembayaran dan transaksi dengan cepat dan aman</p><br>
                        </li>
                        <li>
                            <p>Urus semua pengajuan reschedule dan refund untuk pesananmu tanpa repot.</p><br>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4  kanan">
                    <form action="" method="POST">
                        <div class="judul">
                            <h2>Login</h2>
                        </div>
                        <?php if (isset($error)) : ?>
                            <p style="color: red;">Username / Password Salah</p>
                        <?php endif; ?>
                        <div class="input">
                            <p>Username</p>
                            <input type="text" placeholder="Username" name="username" required>
                            <p>Password</p>
                            <input type="password" placeholder="Password" name="password" required>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="remember" name="remember" style="width:20px; margin-bottom:8px;">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="daftar">
                            <p>Belum punya akun? <a href="registrasi.php">Daftar Sekarang</a> </p>
                        </div>

                        <button type="submit" class="btn btn-primary" name="login">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Website ini dibuat sepenuh hati bagaikan malika</p>
                <footer class="blockquote-footer">Adit - <cite title="Source Title">2020</cite></footer>
            </blockquote>
        </div>
    </div>
</body>

</html>