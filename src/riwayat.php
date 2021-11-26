<?php
session_start();
require('functions.php');
$user = $_SESSION['login'];
$id = query("SELECT user_id FROM user WHERE username = '$user';")[0]['user_id'];
$data = query("SELECT * FROM pesanan WHERE id_user = '$id' ORDER BY id_pesanan DESC;");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/riwayat.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/pesanan.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>GO-FLY</title>
</head>

<body>
    <?php require('header.php'); ?>
    <div class="kotak">
        <p style="font-size: 32pt; margin-top:5px; margin-left:11%;">Riwayat Pesanan</p>
        <?php foreach ($data as $dat) : ?>
            <?php $penerbangan = cariTiketId($dat['id_penerbangan']); ?>
            <div class="kotak_tiket" style="background-color: <?= $penerbangan[0]['warna_maskapai']; ?>;">
                <div class="kotak_tiket_dalam">
                    <!-- <img src="img/logo3.png" alt="" width="100%" height="100%" id="logo"> -->
                    <div class="kotak_kiri">
                        <div class="id_tiket">
                            ID TIKET : <?= $dat['id_pesanan']; ?>
                        </div>
                        <div class="maskapai">
                            <div class="logo">
                                <img src="../assets/img/<?= $penerbangan[0]['logo_maskapai']; ?>" alt="" width="150px" height="150px">
                            </div>
                            <?= $penerbangan[0]['nama_maskapai']; ?>
                        </div>
                    </div>
                    <div class="kotak_kanan">
                        <div class="lokasi">
                            <?= $penerbangan[0]['id_kota_keberangkatan']; ?> ---> <?= $penerbangan[0]['id_kota_tiba']; ?>
                        </div>
                        <div class="jadwal">
                            <p><?= $dat['tanggal_penerbangan']; ?></p>
                            <p><?= $penerbangan[0]['waktu_keberangkatan']; ?> ---> <?= $penerbangan[0]['waktu_tiba']; ?></p>
                        </div>
                        <div class="harga">
                            <div>
                                <p>Total Harga :</p>
                                <b>Rp <?= number_format($dat['total_harga'], 0, '.', '.'); ?>,00</b>
                            </div>
                            <div id="detail">
                                <a href="detail.php?id=<?= $dat['id_pesanan']; ?>" id="link_detail">
                                    <button class="btn btn-primary badge-pill">
                                        Detail
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="clear"></div> -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php require('footer.php'); ?>
</body>

</html>