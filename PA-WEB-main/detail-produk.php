<?php
session_start();
require 'koneksi.php';
if ($_SESSION["priv"] != "admin" and $_SESSION["priv"] != "user"){
    header("Location: detail-produk-guest.php?id=$_GET[id]");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/AZ.ico">
    <title>AnharZtore</title>
    <link rel="stylesheet" href="style-detail-produk.css">
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
                    if ($_SESSION["priv"] == "user"){
                        $username = $_SESSION["username"];
                        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
                        $data = [];
                        while ($row = mysqli_fetch_array($result)) {
                            $data[] = $row;
                        }
                        foreach ($data as $user);
                        $id = $user["id_user"];
                        echo "<li> <a href='pengguna/user/user.php'> HOME </a></li>";
                        echo "<li> <a href='produk/list_barang.php' style='color: #FA022E;'> PRODUCT </a></li>";
                        echo "<li> <a href='pesanan/pesanan_user.php'> ORDER </a></li>";
                        echo "<li> <a href='kontak.php'> KONTAK </a></li>";
                        echo "<li> <a href='pengguna/user/profile.php?id=<?php echo $id; ?>'> PROFILE </a></li>";
                        echo "<li> <a href='logout.php'> LOGOUT </a></li>";
                    }
                    else {
                        echo "<li> <a href='pengguna/admin/admin.php'> HOME </a></li>";
                        echo "<li> <a href='produk/admin_list_barang.php' style='color: #fa022e;'> PRODUCT </a></li>";
                        echo "<li> <a href='pengguna/admin/kelola.php'> DASHBOARD </a></li>";
                        echo "<li> <a href='pengguna/admin/messages.php'> MESSAGES </a></li>";
                        echo "<li> <a href='logout.php'> LOGOUT </a></li>";
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
        <?php
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id");
        $data_produk = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_produk[] = $row;
        }
        foreach ($data_produk as $produk)
        ?>
    <!-- <div class = "main-wrapper"> -->
        <div class = "container">
            <div class = "product-div">
                <div class = "product-div-left">
                    <div class = "img-container">
                        <img src = "img/<?php echo $produk['gambar'];?>" alt = "HP">
                    </div>
                </div>
                <div class = "product-div-right">
                    <span class = "product-name"><?php echo $produk['nama'];?></span>
                    <span class = "product-price">Rp <?php echo number_format($produk['harga'],0,'.','.');?></span>
                    <span class = "product-kategori">Kategori :  <?php echo $produk['kategori'];?></span>
                    <span class = "product-stock">Stock :  <?php echo $produk['stock'];?></span>
                    <span class = "product-description">Deskripsi : <?php echo $produk['deskripsi'];?></span>
                    <a href="cek_login.php?id=<?php echo $produk['id_produk'] ?>" class="btn-produk">Beli Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <script src="scriptidx.js"></script>
</body>

</html>
