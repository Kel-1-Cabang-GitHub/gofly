<div class="header_utama">
    <div class="header">
        <div class="header_logo">
            <a href="index.php">
                <img src="../assets/img/gofly_putih.png" alt="" width="100px" height="100px">
            </a>
        </div>
        <?php if (isset($_SESSION['login'])) : ?>
            <div class="header_navigasi">
                <div class="header_navigasi_foto">
                    <div>
                        <?php
                        $user = $_SESSION['login'];
                        $foto = query("SELECT gambar FROM user WHERE username = '$user';")[0];
                        ?>
                        <img src="../assets/img/<?= $foto['gambar']; ?>" alt="" class="foto_profil">
                        <!-- </a> -->
                    </div>
                    <div class="test">
                        <div class="header_navigasi_akun">
                            <a href="akun.php">Akun-ku</a>
                        </div>
                        <div class="header_navigasi_pesanan">
                            <a href="riwayat.php">Pesanan-Ku</a>
                        </div>
                        <div class="header_navigasi_logout">
                            <a href="logout.php">Log-Out</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="header_navigasi" style="grid-template-columns: 1fr 1fr;">
                <div class="header_navigasi_login">
                    <a href="login.php">Login</a>
                </div>
                <div class="header_navigasi_daftar">
                    <a href="registrasi.php">Daftar</a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>