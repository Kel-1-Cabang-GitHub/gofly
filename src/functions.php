<?php
$conn = mysqli_connect('localhost', 'root', '', 'gofly');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) :
        $rows[] = $row;
    endwhile;
    return $rows;
}

function cariTiket($dari, $menuju)
{
    $penerbangan = query("SELECT 
    penerbangan.id_penerbangan, 
    DATE_FORMAT(penerbangan.waktu_keberangkatan, '%H:%i') AS waktu_keberangkatan,
    DATE_FORMAT(penerbangan.waktu_tiba, '%H:%i') AS waktu_tiba,
    penerbangan.harga_tiket,
    dari.id_kota_keberangkatan,
    menuju.id_kota_tiba,
    kb.nama_kota AS nama_kota_asal ,
    kt.nama_kota AS nama_kota_tiba ,
    maskapai.id_maskapai,
    maskapai.nama_maskapai,
    maskapai.warna_maskapai,
    maskapai.logo_maskapai
    FROM penerbangan
    INNER JOIN dari
    ON penerbangan.id_penerbangan = dari.id_penerbangan
    INNER JOIN menuju
    ON penerbangan.id_penerbangan = menuju.id_penerbangan
    INNER JOIN menggunakan
    ON penerbangan.id_penerbangan = menggunakan.id_penerbangan
    INNER JOIN maskapai
    ON maskapai.id_maskapai = menggunakan.id_maskapai
    INNER JOIN kota AS kb
    ON kb.id_kota = dari.id_kota_keberangkatan
    INNER JOIN kota AS kt
    ON kt.id_kota = menuju.id_kota_tiba
    WHERE kb.nama_kota = '$dari' AND kt.nama_kota = '$menuju';");

    return $penerbangan;
}

function cariTiketId($idpenerbangan)
{
    $penerbangan = query("SELECT 
    penerbangan.id_penerbangan, 
    DATE_FORMAT(penerbangan.waktu_keberangkatan, '%H:%i') AS waktu_keberangkatan,
    DATE_FORMAT(penerbangan.waktu_tiba, '%H:%i') AS waktu_tiba,
    penerbangan.harga_tiket,
    dari.id_kota_keberangkatan,
    menuju.id_kota_tiba,
    kb.nama_kota AS nama_kota_asal ,
    kt.nama_kota AS nama_kota_tiba ,
    maskapai.id_maskapai,
    maskapai.nama_maskapai,
    maskapai.warna_maskapai,
    maskapai.logo_maskapai
    FROM penerbangan
    INNER JOIN dari
    ON penerbangan.id_penerbangan = dari.id_penerbangan
    INNER JOIN menuju
    ON penerbangan.id_penerbangan = menuju.id_penerbangan
    INNER JOIN menggunakan
    ON penerbangan.id_penerbangan = menggunakan.id_penerbangan
    INNER JOIN maskapai
    ON maskapai.id_maskapai = menggunakan.id_maskapai
    INNER JOIN kota AS kb
    ON kb.id_kota = dari.id_kota_keberangkatan
    INNER JOIN kota AS kt
    ON kt.id_kota = menuju.id_kota_tiba
    WHERE penerbangan.id_penerbangan = '$idpenerbangan';");

    return $penerbangan;
}

function insertPesanan($data)
{
    global $conn;

    $id_penerbangan = $data['id_penerbangan'];
    $id_user = $data['user_id'];
    $tanggal = $data['tanggal'];
    $jumlah = $data['jumlah'];
    $totalHarga = $data['totalHarga'];
    $metode = $data['selesai'];
    $data_penumpang = $data['data_penumpang'];

    $query = "INSERT INTO pesanan VALUES ('', '$id_user', '$id_penerbangan', '$tanggal', '$jumlah', '$totalHarga', '$metode', '$data_penumpang');";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;

    $username = htmlspecialchars($data['username']);
    $namaDepan = htmlspecialchars($data['nama_depan']);
    $namaBelakang = htmlspecialchars($data['nama_belakang']);
    $email = htmlspecialchars($data['email']);
    $telepon = htmlspecialchars($data['telepon']);
    $tanggalLahir = htmlspecialchars($data['tgl_lahir']);
    $jk = htmlspecialchars($data['jk']);
    $alamat = htmlspecialchars($data['alamat']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    if ($password !== $password2) :
        echo "<script> alert('Konfirmasi password tidak sesuai');</script>";
        return false;
    endif;

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username';");
    if (mysqli_fetch_assoc($result)) :
        echo "<script> alert('username sudah terdaftar'); </script>";
        return false;
    endif;

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user VALUES ('','$username', '$namaDepan', '$namaBelakang', '$email', '$password', '$telepon', '$tanggalLahir', '$jk', '$alamat', 'profile.png');";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;

    $id = $data['user_id'];
    $namaDepan = htmlspecialchars($data['nama_depan']);
    $namaBelakang = htmlspecialchars($data['nama_belakang']);
    $email = htmlspecialchars($data['email']);
    $tanggalLahir = htmlspecialchars($data['tanggal_lahir']);
    $alamat = htmlspecialchars($data['alamat']);
    $jk = htmlspecialchars($data['jk']);
    $telepon = htmlspecialchars($data['nomor_telepon']);
    $gambarDefault = htmlspecialchars($data['gambar']);
    // $gambarLama = query("SELECT gambar FROM user WHERE user_id = '$id';");
    $gambar = uploadEdit($gambarDefault);
    if (!$gambar) :
        return false;
    endif;

    // if($gambar != $gambarLama[0]['gambar']){
    // 	$dir = "img/" . $gambarLama[0]['gambar'];
    // 	if (is_file($dir)) :
    // 		unlink($dir);
    // 	endif; 
    // }

    $query = "UPDATE user SET
            nama_depan = '$namaDepan',
            nama_belakang = '$namaBelakang',
            email = '$email',
            tanggal_lahir = '$tanggalLahir',
            jenis_kelamin = '$jk',
            alamat = '$alamat',
            nomor_telepon = '$telepon',
            gambar = '$gambar'
            WHERE user_id = '$id';";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function uploadEdit($gambarDefault)
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar yang di upload
    if ($error === 4) :
        return $gambarDefault;
    endif;

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) :
        echo "<script> alert('Yang di upload bukan gambar'); </script>";
        return false;
    endif;

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1_000_000) :
        echo "<script> alert('Ukuran gambar terlalu besar'); </script>";
        return false;
    endif;

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap diupload
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
