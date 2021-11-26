<?php
session_start();
require('functions.php');
if (!isset($_SESSION['login'])) :
    echo "
    <script>
        alert('Anda harus melakukan login terlebih dahulu');
        window.location.href = 'login.php';
    </script>
    ";
endif;
$dari = $_POST['dari'];
$ke = $_POST['ke'];
$data = cariTiket($dari, $ke);
// var_dump($data);
$info = [
    "tanggal_berangkat" => $_POST['berangkat'],
    "kelas" => $_POST['kelas'],
    "jumlah" => $_POST['jumlah']
];
if ($_POST['kelas'] == 'Bisnis') :
    for ($i = 0; $i < count($data); $i++) :
        (int)$data[$i]['harga_tiket'] *= 1.5;
    endfor;
endif;
// foreach ($data as $x) :
//     var_dump($x['harga_tiket']);
// endforeach;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/cari.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>GO - FLY</title>
</head>

<body>
    <?php require('header.php') ?>
    <div class="hasil_cari">
        <div class="tulisan" style="text-align: left;">
            <h1>
                Dari <?= $_POST['dari']; ?> ke <?= $_POST['ke']; ?> :
            </h1>
        </div>
        <?php foreach ($data as $dat) : ?>
            <form action="pesan.php" method="POST">
                <div class="tiket" style="background-color: <?= $dat['warna_maskapai']; ?>;">
                    <div class="kotak_tiket">
                        <!-- <img src="img/logo3.png" alt="" id="logo"> -->
                        <div class="clear"></div>
                        <div class="nama_pesawat">
                            <div class="nama">
                                <?= $dat['nama_maskapai']; ?>
                            </div>
                            <img src="../assets/img/<?= $dat['logo_maskapai']; ?>" alt="">
                        </div>
                        <div class="jadwal_pesawat">
                            <div class="tanggal">
                                <?= $info['tanggal_berangkat']; ?>
                            </div>
                            <div class="berangkat">
                                <div class="waktu_berangkat">
                                    <?= $dat['waktu_keberangkatan']; ?>
                                </div>
                                <div class="asal">
                                    <?= $dat['id_kota_keberangkatan']; ?>
                                </div>
                            </div>
                            <div class="langsung">
                                --->
                            </div>
                            <div class="tiba">
                                <div class="waktu_tiba">
                                    <?= $dat['waktu_tiba']; ?>
                                </div>
                                <div class="tujuan">
                                    <?= $dat['id_kota_tiba']; ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_penerbangan" value="<?= $dat['id_penerbangan']; ?>">
                        <input type="hidden" name="tanggal_berangkat" value="<?= $info['tanggal_berangkat']; ?>">
                        <input type="hidden" name="kelas" value="<?= $info['kelas']; ?>">
                        <input type="hidden" name="jumlah" value="<?= $info['jumlah']; ?>">
                        <div class="aksi">
                            <div class="harga" style="font-size: 18pt;">Rp <?= number_format($dat['harga_tiket'], 0, '.', '.'); ?>,00</div>
                            <button type="submit" class="btn btn-primary badge-pill mt-4 pl-4 pr-4" style="font-size: 14pt;">
                                <!-- <a href="pesan.php" style="text-decoration: none; color:black;"> -->
                                Pilih
                                <!-- </a> -->
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
    <?php require('footer.php') ?>
</body>

</html>