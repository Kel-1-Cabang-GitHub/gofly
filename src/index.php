<?php
session_start();
require('functions.php');

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) :
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE user_id = '$id';");
    $row = mysqli_fetch_assoc($result);
    if ($key === hash('sha256', $row['username'])) :
        $_SESSION['login'] = $row['username'];
    endif;
endif;
// require('functions.php');
// if(isset($_POST['cari'])):
// var_dump(cariTiket($_POST['dari'], $_POST['ke']));
// endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <title>GO - FLY</title>
</head>

<body>
    <div class="kotak_1">
        <?php require('header_index.php'); ?>
        <div class="karousel">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../assets/img/test.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/img/danau.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/img/danaubali.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- </div> -->
        <div class="kotak_form">
            <div class="judul_form">Selamat Datang Di Go-Fly</div>
            <div class="isi_form">
                <form action="cari.php" method="POST">
                    <div class="bagian_form">
                        <label for="dari">Dari : </label>
                        <select name="dari" id="dari" class="custom-select" required>
                            <option value="" disabled selected>Kota Asal</option>
                            <option value="Jambi">Jambi</option>
                            <option value="Palembang">Palembang</option>
                            <option value="Medan">Medan</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Bali">Bali</option>
                            <option value="Pontianak">Pontianak</option>
                            <option value="Samarinda">Samarinda</option>
                            <option value="Makassar">Makassar</option>
                        </select>
                    </div>
                    <div class="bagian_form">
                        <label for="ke">Ke : </label>
                        <select name="ke" id="ke" class="custom-select" required>
                            <option value="" disabled selected>Kota Tujuan</option>
                            <option value="Jambi">Jambi</option>
                            <option value="Palembang">Palembang</option>
                            <option value="Medan">Medan</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Bali">Bali</option>
                            <option value="Pontianak">Pontianak</option>
                            <option value="Samarinda">Samarinda</option>
                            <option value="Makassar">Makassar</option>
                        </select>
                    </div>
                    <div class="bagian_form">
                        <label for="berangkat">Tanggal : </label>
                        <input class="form-control datepicker" type="date" name='berangkat' value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <!-- <div class="bagian_form">
                        <label for="pulang">Pulang : </label>
                        <input type="date" name='pulang' value="<?php echo date('Y-m-d'); ?>">
                    </div> -->
                    <div class="bagian_form">
                        <label for="kelas">Kelas : </label>
                        <select name="kelas" id="kelas" required class="custom-select">
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Bisnis">Bisnis</option>
                        </select>
                    </div>
                    <div class="bagian_form" style="text-align: center;">
                        <label for="jumlah">Jumlah Penumpang : </label>
                        <input type="number" class="form-control" style="width: 60px; margin:auto;" name="jumlah" min="1" value="1" required>
                    </div>
                    <div class="clear"></div>
                    <div class="tombolCari">
                        <button type="submit" name="cari" class="btn btn-success badge-pill">
                            Cari Tiket
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="konten">
            <p>
            <div class="teks_kel">
                <!-- &#128405; -->
                Kelebihan Kami
                <!-- &#128405; -->
            </div>
            </p>
            <div class="konten_dalam">
                <div class="kel1">
                    <div>
                        <img src="../assets/img/tiket.png" width="60" height="60" style="display:block; margin:auto;" alt="">
                    </div>
                    <div>
                        <b>Pesan Tiket Gak Ribet</b>
                    </div>
                    <div>
                        <p>Pesan tiket pesawat dengan mudah. Gak ribet, hanya dengan satu sentuhan jari, tiket yang kamu butuhkan bisa didapatkan dengan mudah.</p>
                    </div>
                </div>
                <div class="kel2">
                    <img src="../assets/img/list.png" width="60" height="60" style="display:block; margin:auto;" alt="">
                    <b>Pilihan Maskapai Beragam</b>
                    <p>Ada banyak pilihan maskapai dengan rute terlengkap ke seluruh kota di Indonesia. </p>
                </div>
                <div class="kel3">
                    <img src="../assets/img/kartu.png" width="60" height="60" style="display:block; margin:auto;" alt="">
                    <b style="font-size: 11pt;">Banyak Pilihan Cara Pembayaran</b>
                    <p>Saat transaksi, kamu bisa memilih cara pembayaran sesuai keinginan. Ada pilihan pembayaran via bank transfer, ATM transfer, Virtual Account (VA), kartu debit online, maupun kartu kredit. Bisa dicicil juga, lho. Prosesnya mudah dan simpel!</p>
                </div>
                <div class="kel4">
                    <img src="../assets/img/harga.png" width="60" height="60" style="display:block; margin:auto;" alt="">
                    <b>Harga Terjangkau</b>
                    <p>Harga tiket pesawat kami memeliki harga yang bersahabat. Sehingga kamu dapat berlibur bersama keluargamu.</p>
                </div>
                <div class="kel5">
                    <img src="../assets/img/cepat.png" width="60" height="60" style="display:block; margin:auto;" alt="">
                    <b>Proses Cepat</b>
                    <p>Ketika sudah memesan dan membayar tiket, kamu dapat mengambil tiketmu secara online sehingga ketika hari penerbangan tidak perlu lagi mengambil tiket di bandara</p>
                </div>
                <div class="kel6">
                    <img src="../assets/img/247.png" width="60" height="60" style="display:block; margin:auto;" alt="">
                    <b>Setiap Hari, Setiap Jam</b>
                    <p>Melalui pelayanan 24/7 , kami akan selalu ada buat kamu. Dapatkan bantuan untuk pemesanan tiketmu dengan pelayanan 24/7 dari GO-FLY!.</p>
                </div>
            </div>
        </div>
    </div>
    <?php require('footer.php'); ?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>