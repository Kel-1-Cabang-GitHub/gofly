<?php
session_start();
require('functions.php');
if (!isset($_SESSION['login'])) :
    header('Location: index.php');
endif;
$id_penerbangan = $_POST['id_penerbangan'];
$data_penerbangan = cariTiketId($id_penerbangan);
// var_dump($_POST);
// var_dump($data_penerbangan);
$hargaTotal = (int)$_POST['jumlah'] * (int)$data_penerbangan[0]['harga_tiket'];
// var_dump($hargaTotal);
if ($_POST['kelas'] == 'Bisnis') :
    $hargaTotal *= 1.5;
endif;
// var_dump(number_format($hargaTotal,3,'.',','));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/pesan.css">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>GO - FLY</title>
</head>

<body>
    <?php require('header.php'); ?>
    <form action="bayar.php" method="POST">
        <div class="kotak_utama">
            <div class="kotak_1">
                <?php $j = 1; ?>
                <?php for ($i = 0; $i < $_POST['jumlah']; $i++) : ?>
                    <div class="kotak_form">
                        <h1>Data Penumpang <?= $j++; ?> :</h1>
                        <div class="titel" style="margin-bottom:10px;">
                            Titel :
                            <label for="titel">Tuan</label>
                            <input type="radio" id="titel" value="Tuan" name="titel<?= $j - 1; ?>" required>
                            <label for="titel">Nyonya</label>
                            <input type="radio" id="titel" value="Nyonya" name="titel<?= $j - 1; ?>">
                        </div>
                        <table width=100%; cellpadding='10'>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td>
                                    <input class="form-group mt-3" type="text" name="nama<?= $j - 1; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>E-Mail</td>
                                <td>:</td>
                                <td>
                                    <input class="form-group mt-3" type="email" name="email<?= $j - 1; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>
                                    <input class="form-group mt-3" type="date" name="tgl_lahir<?= $j - 1; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>:</td>
                                <td>
                                    <input class="form-group mt-3" type="tel" name="telepon<?= $j - 1; ?>" required>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="kotak_total" style="text-align: center; font-size:16pt;">
                <p>Penerbangan <?= $data_penerbangan[0]['id_penerbangan']; ?></p>
                <img src="../assets/img/<?= $data_penerbangan[0]['logo_maskapai'] ?>" alt="" style="width:100px; height:100px;">
                <p><?= $data_penerbangan[0]['nama_kota_asal']; ?> ---> <?= $data_penerbangan[0]['nama_kota_tiba']; ?></p>
                <p>Berangkat : <?= $_POST['tanggal_berangkat']; ?> <?= $data_penerbangan[0]['waktu_keberangkatan']; ?></p>
                <p>Tiba : <?= $_POST['tanggal_berangkat']; ?> <?= $data_penerbangan[0]['waktu_tiba']; ?></p>
                <p>Total Harga : Rp <?= number_format($hargaTotal, 0, '.', '.'); ?>,00</p>
                <button type="submit" name="submit" class="btn btn-primary badge-pill">
                    Lanjutkan Ke Pembayaran
                </button>
            </div>
        </div>
        <input type="hidden" name="id_penerbangan" value="<?= $data_penerbangan[0]['id_penerbangan']; ?>">
        <input type="hidden" name="tanggal_berangkat" value="<?= $_POST['tanggal_berangkat']; ?>">
        <input type="hidden" name="kelas" value="<?= $_POST['kelas']; ?>">
        <input type="hidden" name="jumlah" value="<?= $_POST['jumlah']; ?>">
    </form>
    <?php require('footer.php') ?>
</body>

</html>