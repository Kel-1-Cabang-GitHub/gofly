<?php
session_start();
require('functions.php');
if (!isset($_SESSION['login'])) :
    header('Location: index.php');
endif;
// var_dump($_POST);
$data_penerbangan = cariTiketId($_POST['id_penerbangan']);
// var_dump($data_penerbangan);
$user = $_SESSION['login'];
$id = query("SELECT user_id FROM user WHERE username = '$user';");
$passengers = [];
foreach ($_POST as $x => $xx) :
    for ($i = 1; $i <= $_POST['jumlah']; $i++) {
        if (preg_match('/nama' . $i . '/i', $x) > 0) :
            $passengers[$i - 1]['nama'] = $xx;
        endif;
        if (preg_match('/titel' . $i . '/i', $x) > 0) :
            $passengers[$i - 1]['titel'] = $xx;
        endif;
        if (preg_match('/email' . $i . '/i', $x) > 0) :
            $passengers[$i - 1]['email'] = $xx;
        endif;
        if (preg_match('/tgl_lahir' . $i . '/i', $x) > 0) :
            $passengers[$i - 1]['tgl_lahir'] = $xx;
        endif;
        if (preg_match('/telepon' . $i . '/i', $x) > 0) :
            $passengers[$i - 1]['telepon'] = $xx;
        endif;
    }
endforeach;
$json_passengers = json_encode($passengers);
// var_dump($json_passengers);
$hargaTotal = (int)$_POST['jumlah'] * (int)$data_penerbangan[0]['harga_tiket'];
$x = false;
if (isset($_POST['selesai'])) :
    // var_dump($_POST);
    if (insertPesanan($_POST) > 0) :
        $x = true;
    endif;
endif;
if ($x === false) :
    // var_dump($data_penerbangan);
    if ($_POST['kelas'] == 'Bisnis') :
        $hargaTotal *= 1.5;
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/bayar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/selesai.css">
    <title>GO-FLY</title>
</head>

<body style="position: relative;">
    <?php require('header.php'); ?>
    <?php if ($x === true) :
        require('selesai.php');
    endif; ?>
    <div class="kotak_utama">
        <div class="kotak_kiri_main">
            <form action="" method="POST">
                <input type="hidden" name="id_penerbangan" value="<?= $data_penerbangan[0]['id_penerbangan']; ?>">
                <input type="hidden" name="tanggal" value="<?= $_POST['tanggal_berangkat']; ?>">
                <input type="hidden" name="jumlah" value="<?= $_POST['jumlah']; ?>">
                <input type="hidden" name="totalHarga" value="<?= $hargaTotal; ?>">
                <input type="hidden" name="user_id" value="<?= $id[0]['user_id']; ?>">
                <input type="hidden" name="data_penumpang" value='<?= $json_passengers; ?>'>
                <p style="font-size:36pt;">
                    Metode Pembayaran
                </p>
                <div class="kotak_kiri"">
                <table cellpadding=" 10">
                    <tr>
                        <th>
                            <h2>Kartu Kredit / Debit</h2>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="selesai" class="tombolbeli" value="Kartu Kredit">
                                <div style="text-align: left;">Kartu Kredit</div>
                                <div>
                                    <img src="../assets/img/metode/kartukredit.png" width="30px" height="30px" alt="">
                                </div>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="selesai" class="tombolbeli" value="Kartu Debit">
                                <div style="text-align: left;">Kartu Debit</div>
                                <div><img src="../assets/img/metode/kartudebit.png" width="30px" height="30px" alt=""></div>
                            </button>
                        </td>
                    </tr>
                    </table>
                </div>
                <div class="clear"></div>
                <div class="kotak_kiri" style="margin-top: 50px;">
                    <table cellpadding="10">
                        <tr>
                            <th>
                                <h2>Cicilan Tanpa Kartu Kredit</h2>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Kredivo">
                                    <div style="text-align: left;">Kredivo</div>
                                    <div>
                                        <img src="../assets/img/metode/kredivo.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Akulaku">
                                    <div style="text-align: left;">Akulaku</div>
                                    <div>
                                        <img src="../assets/img/metode/akulaku.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="kotak_kiri" style="margin-top: 50px;">
                    <table cellpadding="10">
                        <tr>
                            <th>
                                <h2>Virtual Account</h2>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="BCA Virtual Account">
                                    <div style="text-align: left;">BCA Virtual Account</div>
                                    <div>
                                        <img src="../assets/img/metode/bca.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Mandiri Virtual Account">
                                    <div style="text-align: left;">Mandiri Virtual Account</div>
                                    <div>
                                        <img src="../assets/img/metode/mandiri.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="BNI Virtual Account">
                                    <div style="text-align: left;">BNI Virtual Account</div>
                                    <div>
                                        <img src="../assets/img/metode/bni.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="BRIVA">
                                    <div style="text-align: left;">BRIVA</div>
                                    <div>
                                        <img src="../assets/img/metode/bri.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="kotak_kiri" style="margin-top: 50px;">
                    <table cellpadding="10">
                        <tr>
                            <th>
                                <h2>Instant Payment</h2>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Go-Pay">
                                    <div style="text-align: left;">Go-Pay</div>
                                    <div>
                                        <img src="../assets/img/metode/gopay.png" width="50px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="KlikBCA">
                                    <div style="text-align: left;">KlikBCA</div>
                                    <div>
                                        <img src="../assets/img/metode/klikbca.jpg" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Saku-ku">
                                    <div style="text-align: left;">Saku-ku</div>
                                    <div>
                                        <img src="../assets/img/metode/sakuku.png" width="30px" height="30px" alt="" style="transform: scale(2);">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="BCA Klikpay">
                                    <div style="text-align: left;">BCA Klikpay</div>
                                    <div>
                                        <img src="../assets/img/metode/bcaklikpay.png" width="50px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="OCTO Clicks">
                                    <div style="text-align: left;">OCTO Clicks</div>
                                    <div>
                                        <img src="../assets/img/metode/octoclicks.svg" width="30px" height="30px" alt="" style="transform: scale(2);">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="LinkAja">
                                    <div style="text-align: left;">LinkAja</div>
                                    <div>
                                        <img src="../assets/img/metode/linkaja.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="kotak_kiri" style="margin-top: 50px;">
                    <table cellpadding="10">
                        <tr>
                            <th>
                                <h2>ATM</h2>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="ATM">
                                    <div style="text-align: left;">ATM</div>
                                    <div>
                                        <img src="../assets/img/metode/atm.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="kotak_kiri" style="margin-top: 50px;">
                    <table cellpadding="10">
                        <tr>
                            <th>
                                <h2>Transfer</h2>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Bank BCA">
                                    <div style="text-align: left;">Bank BCA</div>
                                    <div>
                                        <img src="../assets/img/metode/bca.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Bank Mandiri">
                                    <div style="text-align: left;">Bank Mandiri</div>
                                    <div>
                                        <img src="../assets/img/metode/mandiri.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="kotak_kiri" style="margin-top: 50px;">
                    <table cellpadding="10">
                        <tr>
                            <th>
                                <h2>Gerai Retail</h2>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Alfamart">
                                    <div style="text-align: left;">Alfamart</div>
                                    <div>
                                        <img src="../assets/img/metode/alfamart.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="selesai" class="tombolbeli" value="Indomaret">
                                    <div style="text-align: left;">Indomaret</div>
                                    <div>
                                        <img src="../assets/img/metode/indomaret.png" width="30px" height="30px" alt="">
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
        <div class="kotak_kanan">
            <p style="font-size: 20pt; text-align:center;"><?= $data_penerbangan[0]['nama_kota_asal']; ?> -> <?= $data_penerbangan[0]['nama_kota_tiba']; ?></p>
            <p style="font-size: 18pt; margin-top:-20px; text-align:center"><?= $data_penerbangan[0]['id_penerbangan']; ?></p>
            <table border="1px">
                <tr style="background-color: #84c1ff;">
                    <th>Penumpang</th>
                </tr>
                <?php foreach ($passengers as $passenger) : ?>
                    <tr>
                        <td><?= $passenger['titel']; ?> <?= $passenger['nama']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p style="margin-top: 50px; font-size:14pt; float:left;">Total Pembayaran</p>
            <p style="margin-top: 50px; font-size:14pt; float: right;">Rp <?= number_format($hargaTotal, 0, '.', '.'); ?>,00</p>
        </div>
    </div>
    <?php require('footer.php'); ?>
</body>
<script src="../assets/js/selesai.js"></script>

</html>