<?php
    session_start();
    if ($_SESSION["priv"] != "user") {
        header("Location: ../../login.php");
    }

    require "../../koneksi.php";
    $username = $_SESSION["akun"];
    
    $result = mysqli_query($conn, "SELECT * FROM pesanan WHERE username = '$username'");
    $pesanan = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pesanan[] = $row;
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
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                    <li> <a href="aboutUser.php"> PROFILE </a></li>
                    <li> <a href="../../logout.php"> LOGOUT </a></li>
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
        <div class="crud">
            <h1> Kelola Pesanan Anda </h1>
            <div class="btn-kelola">
                <button> <a href="order.php"> Tambah Data  </a> </button>
            </div>
            <table border="1">
                <tr height="50px">
                    <th width="1%"> No. </th>
                    <th width="18%"> Nama </th>
                    <th width="10%"> No. Telp </th>
                    <th width="20%"> Merk HP </th>
                    <th width="5%"> Jumlah </th>
                    <th width="21%"> Alamat </th>
                    <th width="10%"> Pembayaran </th>
                    <th width="15%" colspan="2"> Kelola </th>
                </tr>
                <?php $i = 1; foreach ($pesanan as $pesan):?>
                <tr>
                    <td> <?php echo $i ;?> </td>
                    <td> <?php echo $pesan['atas_nama'] ;?> </td>
                    <td> <?php echo $pesan['no_telp'] ;?> </td>
                    <td> <?php echo $pesan['merk'] ;?> </td>
                    <td> <?php echo $pesan['jumlah'] ;?> </td>
                    <td> <?php echo $pesan['alamat'] ;?> </td>
                    <td> <?php echo $pesan['metode'] ;?> </td>
                    <td width="4%"> <a href="edit.php?id=<?php echo $pesan['id']; ?>" class="updt"> <i class="material-icons" style="font-size:26px;color:green">update</i> </td> </a>
                    <td width="4%"> <a href="hapus.php?id=<?php echo $pesan['id']; ?>" class = "dlt"> <i class="material-icons" style="font-size:26px;color:red">delete</i> </a> </td>
                </tr>
                <?php $i++; endforeach;?>
            </table>
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