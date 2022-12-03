<?php
    session_start();
    if ($_SESSION["priv"] != "user" and $_SESSION["priv"] != "admin") {
        header("Location: login.php");
    }

    require '../koneksi.php';
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM pesanan WHERE id=$id");

    if (isset($_POST["tambah"])) {
        $nama = htmlspecialchars($_POST["nama"]);
        $no_telp = htmlspecialchars($_POST["no_telp"]);
        $merk = htmlspecialchars($_POST["merk"]);
        $jumlah = htmlspecialchars($_POST["jumlah"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        $metode = htmlspecialchars($_POST["metode"]);

        $sql = "UPDATE pesanan SET nama = '$nama', no_telp = '$no_telp', merk = '$merk', jumlah = $jumlah, alamat = '$alamat', metode = '$metode' WHERE id = '$id'";

        $result = mysqli_query($conn, $sql);

        if ( $result ) {
            echo"
                <script>
                    alert('Data berhasil diubah');
                </script>
            ";
        }else{
            echo"
                <script>
                    alert('Data gagal diubah');
                </script>
            ";
        }
        if ($_SESSION["priv"] == "user"){
            header("Location: order_user.php");
        } else {
            header("Location: pesan.php");
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
    <link rel="stylesheet" href="../style.css">
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
                    <?php
                        if ($_SESSION["priv"] == "user"){
                            echo "<li> <a href='order_user.php'> ORDER </a></li>";
                            echo "<li> <a href='aboutUser.php'> ABOUT </a></li>";
                        } else {
                            echo "<li> <a href='kelola.php'> KELOLA </a></li>";
                        }
                    ?>
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
        <div class="form">
            <form method="post" action="">
                <h2>Form Update Data Pesanan</h2>
                <div class="order-detail">
                    <div class="input">
                        <span class="detail"> Nama Lengkap </span>
                        <input name="nama" type="text" maxlength="40" placeholder="Masukkan Nama Lengkap Pemesan" required>
                    </div>
                    <div class="input">
                        <span class="detail"> Nomor HP </span>
                        <input name="no_telp" type="tel" pattern="[0-9]{10-15}" maxlength="15" placeholder="08xxxxxxxxxx" id="phone" required>
                    </div>
                    <div class="input">
                        <span class="detail"> Merk HP </span>
                        <select name="merk">
                            <option value=""></option>
                            <option value="Samsung Galaxy A71"> Samsung Galaxy A71 </option>
                            <option value="Apple iPhone 14 Pro Max"> Apple iPhone 14 Pro Max </option>
                            <option value="Vivo V25 Pro Max"> Vivo V25 Pro Max </option>
                            <option value="Realme GT Neo 3T"> Realme GT Neo 3T </option>
                            <option value="Oppo Reno8 Pro"> Oppo Reno8 Pro </option>
                            <option value="Xiaomi Poco X4 Pro 5G"> Xiaomi Poco X4 Pro 5G </option>
                        </select>
                    </div>
                    <div class="input">
                        <span class="detail"> Jumlah Order </span>
                        <input name="jumlah" min="1" type="number" placeholder="Masukkan Jumlah HP Yang Dipesan" required>
                    </div>
                    <div class="input">
                        <span class="detail"> Alamat Lengkap </span>
                        <input name="alamat" type="text" maxlength="40" placeholder="Masukkan Alamat Lengkap Pemesan" required>
                    </div>
                    <div class="metodePembayaran">
                        <input type="radio" name="metode" id="dot1" required value="Cash">
                        <input type="radio" name="metode" id="dot2" required value="Online">
                        <input type="radio" name="metode" id="dot3" required value="Lainnya">
                        <span class="pembayaran"> Metode Pembayaran </span>
                        <div class="method">
                            <label for="dot1">
                                <span class="dot one"></span>
                                <span class="metode"> Cash </span>
                            </label>
                            <label for="dot2">
                                <span class="dot two"></span>
                                <span class="metode"> Online </span>
                            </label>
                            <label for="dot3">
                                <span class="dot three"></span>
                                <span class="metode"> Lainnya </span>
                            </label>
                        </div>
                    </div>
                    <div class="submitButton">
                        <input type="submit" value="Submit" name="tambah">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="bawah">
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
        
    <script src="scriptorder.js"></script>
</body>
</html>