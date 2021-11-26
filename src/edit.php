<?php
session_start();
require('functions.php');
$id = $_GET['id'];
$data = query("SELECT * FROM user WHERE user_id = '$id';");

if (isset($_POST['edit'])) :
    if (edit($_POST) > 0) :
        echo "
        <script>
            alert('Edit Akun berhasil');
            window.location.href = 'akun.php';
        </script>
        ";
    else :
        echo "
        <script>
            alert('Edit Akun gagal');
            window.location.href = 'akun.php';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/akun.css">
    <link rel="shortcut icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo4.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>GO-FLY</title>
</head>

<body>
    <?php require('header.php'); ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?= $data[0]['user_id']; ?>" name="user_id">
        <div class="kotak">
            <p>Edit Akun</p>
            <div class="gambar">
                <img src="../assets/img/<?= $data[0]['gambar']; ?>" width="100%" alt="" id="profil_edit">
            </div>
            <input type="file" name="gambar" onchange="document.getElementById('profil_edit').src = window.URL.createObjectURL(this.files[0])" style="justify-self: center; width:200px; margin-bottom:10px;">
            <table cellpadding=20>
                <tr>
                    <td>Nama Depan</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_depan" value="<?= $data[0]['nama_depan']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nama Belakang</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_belakang" value="<?= $data[0]['nama_belakang']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>:</td>
                    <td>
                        <input type="email" name="email" value="<?= $data[0]['email']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        <input type="date" name="tanggal_lahir" value="<?= $data[0]['tanggal_lahir']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <textarea name="alamat" id="" cols="35" rows="3" style="font-size: 12pt;"><?= $data[0]['alamat']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td style="text-align:center;">
                        <input type="radio" name="jk" id="jk1" value="Pria" <?php if ($data[0]['jenis_kelamin'] === 'Pria') {
                                                                                echo 'checked';
                                                                            } ?>>
                        <label for="jk1" style="margin-right:10px;">Pria</label>
                        <input type="radio" style="margin-left: 10px;" id="jk2" name="jk" value="Wanita" <?php if ($data[0]['jenis_kelamin'] === 'Wanita') {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                        <label for="jk2">Wanita</label>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td>
                        <input type="tel" name="nomor_telepon" value="<?= $data[0]['nomor_telepon']; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;" colspan="3">
                        <button type="submit" name="edit" class="btn btn-warning badge-pill mr-2" style="font-size: 20pt;">
                            Simpan
                        </button>
                        <button class="btn btn-danger badge-pill">
                            <a href="akun.php" style="text-decoration: none; color:black;font-size:20pt;">
                                Batal
                            </a>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <?php require('footer.php'); ?>
</body>

</html>