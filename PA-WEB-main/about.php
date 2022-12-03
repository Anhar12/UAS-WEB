<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/AZ.ico">
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
                    <li> <a href="index.php"> HOME </a></li>
                    <li> <a href="index.php"> PRODUCT </a></li>
                    <li> <a href="about.php"> ABOUT </a></li>
                    <li> <a href="login.php"> LOGIN </a></li>
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

    <div class="bawah">
        <div class="container" id="product">
            <!-- footer -->
            <footer>
              <div class="footer">
                  <p>
                      Jangan lupa belanja di AnharZtore, serta follow akun ig kami <a href="https://www.instagram.com/anharZtore/" id="ig"> @anharZtore </a>
                  </p>
              </div>
              <div id="kontak">
                  <i class="fa fa-whatsapp"> 085845723207 </i>
                  <i class="fa fa-instagram"> anharZtore </i>
                  <i class="fa fa-envelope-o"> anharZtore@gmail.com </i>
                  <i class="fa fa-github"> anharZtore </i>
              </div>
              <p> @Copyright 2022 - anharZtore - Made with HTML, CSS, JS, & PHP </p>
            </footer>
        </div>        
    </div>
    
    <script src="scriptabout.js"></script>
</body>
</html>
