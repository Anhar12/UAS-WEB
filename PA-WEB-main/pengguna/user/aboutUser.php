<?php
    session_start();
    if ($_SESSION["priv"] != "user") {
        header("Location: login.php");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- header -->
    <div class="atas">
        <nav>
            <a href="index.html" id="logo"> Anhar <font color="#f86909"> Ztore </font> </a>
            <div class="navbar">
                <ul>
                    <li> <a href="user.php"> HOME </a></li>
                    <li> <a href="user.php"> PRODUCT </a></li>
                    <li> <a href="order_user.php"> ORDER </a></li>
                    <li> <a href="aboutUser.php"> ABOUT </a></li>
                    <li> <a href="logout.php"> LOGOUT </a></li>
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
        <div class="about">
            <div class="kolomAbout">
                <img src="img/aku.jpeg">
            </div>
            <div class="kolomAbout">
                <h1> Halo! Perkenalkan</h1>
                <p>Saya Anhar Khoirun Najib mahasiswa Universitas Mulawarman prodi Informatika,
                <br> asal saya dari rumah awalnya, tapi sekarang ngekos, cita cita saya ingin menjadi 
                <br> programmer walaupun saya malas ngodink tapi semoga tercapai aaamiiin
                <br>
                    Adapun Biodata saya sebagai berikut : <br/> <br/>
                    Nama : Anhar Khoirun Najib <br/>
                    NIM : 2109106081 <br/>
                    TTL : Sangatta, 13 Januari 2003 <br/>
                    Nomor Hp : 0858 4572 3207 <br/>
                    Alamat : Jl. Apt. Pranoto, Gg. Purnama, No.176 <br/>
                </p>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="bawah">
        <footer class="footerAbout">
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
    
    <script src="scriptabout.js"></script>
</body>
</html>