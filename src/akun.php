<?php
session_start();
require('functions.php');
$user = $_SESSION['login'];
$data = query("SELECT * FROM user WHERE username = '$user';");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/akun.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>GO-FLY</title>
</head>

<body>
    <?php require('header.php'); ?>
    <div class="kotak">
        <p>Informasi Akun</p>
        <div class="gambar">
            <img src="../assets/img/<?= $data[0]['gambar']; ?>" width="100%" alt="">
        </div>
        <table cellpadding=20>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $data[0]['nama_depan']; ?> <?= $data[0]['nama_belakang']; ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td>:</td>
                <td><?= $data[0]['email']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><?= $data[0]['tanggal_lahir']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $data[0]['alamat']; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $data[0]['jenis_kelamin']; ?></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td>:</td>
                <td><?= $data[0]['nomor_telepon']; ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <button class="btn btn-warning badge-pill">
                        <a href="edit.php?id=<?= $data[0]['user_id']; ?>" style="text-decoration: none; color:black; font-size:20pt;">
                            Edit Profil
                        </a>
                    </button>
                </td>
                <td></td>
                <td style="text-align: center;">
                    <button class="btn btn-danger badge-pill">
                        <a href="logout.php" style="text-decoration: none; color:black;font-size:20pt;">
                            Log Out
                        </a>
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <?php require('footer.php'); ?>
</body>

</html>