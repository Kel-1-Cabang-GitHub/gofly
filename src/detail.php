<?php
session_start();
require('functions.php');
$id = $_GET['id'];
$data = query("SELECT * FROM pesanan WHERE id_pesanan = '$id';")[0];
$idpemesan = $data['id_user'];
$pemesan = query("SELECT * FROM user WHERE user_id = '$idpemesan';")[0];
$passengers = json_decode($data['data_penumpang'], true);
// var_dump($passengers);
// var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/detail.css">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>Document</title>
</head>

<body>
    <?php require('header.php'); ?>
    <div class="bodi">
        <div class="kotak">
            <div id="judul">Detail Tiket</div>
            <div>ID Tiket : <?= $data['id_pesanan']; ?></div>
            <div>Pemesan Tiket : <?= $pemesan['nama_depan']; ?> <?= $pemesan['nama_belakang']; ?></div>
            <div>ID Penerbangan : <?= $data['id_penerbangan']; ?></div>
            <div>Tanggal Penerbangan : <?= $data['tanggal_penerbangan']; ?></div>
            <div>Jumlah Tiket : <?= $data['jumlah_penumpang']; ?> Orang</div>
            <div>Total Harga : Rp <?= number_format($data['total_harga'], 0, '.', '.'); ?>,00</div>
            <div>Metode Pembayaran : <?= $data['metode_pembayaran']; ?></div>
            <div>Informasi Penumpang :</div>
            <div>
                <table border="1" style="border-collapse: collapse; width:100%; text-align:center;">
                    <tr>
                        <th>No</th>
                        <th>Nama Penumpang</th>
                        <th style="width: 250px;">E-Mail</th>
                        <th>Tanggal Lahir</th>
                        <th>Nomor Telepon</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($passengers as $passenger) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $passenger['titel']; ?> <?= $passenger['nama']; ?></td>
                            <td><?= $passenger['email']; ?></td>
                            <td><?= $passenger['tgl_lahir']; ?></td>
                            <td><?= $passenger['telepon']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div style="justify-self:right;">
                <button class="btn btn-primary badge-pill">
                    <a href="riwayat.php" style="color:black; text-decoration:none;">
                        Kembali
                    </a>
                </button>
            </div>
        </div>
    </div>
    <?php require('footer.php'); ?>
</body>

</html>