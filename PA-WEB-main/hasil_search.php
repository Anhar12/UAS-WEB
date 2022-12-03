<?php
    session_start();
    require 'koneksi.php';

    if (isset($_POST['search'])){
        $cari = $_POST['cari'];

        $result = mysqli_query($conn, "SELECT * FROM barang WHERE nama like '$cari%' or nama like '%$cari' or nama like '%$cari%'");
        
        $search = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $search[] = $row;
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/AZ.ico">
    <title>AnharZtore</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- header -->
    <div class="atas">
        <nav>
            <a href="index.php" id="logo"> Anhar <font color="#f86909"> Ztore </font> </a>
            <div class="navbar">
                <ul>
                    <?php 
                        if ($_SESSION["priv"] == "admin"){
                            echo '<li> <a href="admin.php"> HOME </a></li>';
                            echo '<li> <a href="admin.php"> PRODUCT </a></li>';
                            echo '<li> <a href="kelola.php"> KELOLA </a></li>';
                            echo '<li> <a href="logout.php"> LOGOUT </a></li>';
                        } else if ($_SESSION["priv"] == "user"){
                            echo '<li> <a href="user.php"> HOME </a></li>';
                            echo '<li> <a href="user.php"> PRODUCT </a></li>';
                            echo '<li> <a href="order.php"> ORDER </a></li>';
                            echo '<li> <a href="aboutUser.php"> ABOUT </a></li>';
                            echo '<li> <a href="logout.php"> LOGOUT </a></li>';
                        } else {
                            echo '<li> <a href="index.php"> HOME </a></li>';
                            echo '<li> <a href="index.php"> PRODUCT </a></li>';
                            echo '<li> <a href="abou.php"> ABOUT </a></li>';
                            echo '<li> <a href="login.php"> LOGIN </a></li>';
                        }
                    ?>
                    <li>
                        <label>
                            <input type="checkbox" class="checkbox" id="tombol">
                            <span class="check"></span>
                        </label>
                    </li>
                </ul>
            </div>
        </nav>

    <!-- main content -->
        <div class="hsl_cari">
            <h2>Hasil Pencarian</h2>
        </div>
        <div class="hsl_search">
            <?php $i = 1; foreach ($search as $src):?>
                <div class="kolom">
                    <div class="produk-detail">
                        <div class="produk-img">
                            <img src="img/<?= $src['nama_file']; ?>">
                        </div>
                        <div class="desc-produk">
                            <?php echo $src['spesifikasi']; ?>
                        </div>
                    </div>
                    <div class="merk">
                        <?php echo $src['nama']; ?>
                    </div>
                </div>
            <?php $i++; endforeach;?>
        </div>
    </div>

    <div class="bawahHome">
        <!-- footer -->
        <footer>
            <div class="footer">
                <p>
                    Jangan lupa belanja di AnharZtore, serta follow akun ig saya <a href="https://www.instagram.com/anharrrrrr_/" id="ig"> @anharrrrrr_ </a> 
                    <br>
                    Demikian tampilan web Posttest 5 saya, wassalamualaikum warahmatullahi wabarakatuh
                </p>
            </div>
            <div id="kontak">
                <i class="fa fa-whatsapp"> 085845723207 </i>
                <i class="fa fa-instagram"> anharrrrrr_ </i>
                <i class="fa fa-envelope-o"> anharkhoirun@gmail.com </i>
                <i class="fa fa-github"> Anhar12 </i>
            </div>
            <p> @Copyright 2022 - anharrrslbw - Made with HTML, CSS, JS, & PHP </p>
        </footer>

    </div>
    <script src="scriptidx.js"></script>
</body>
</html>