<?php
    session_start();
    if ($_SESSION["priv"] != "user") {
        header("Location: ../login.php");
    }

    require '../koneksi.php';
    $_SESSION["id_pesanan"] = $_GET["id"];
    $result = mysqli_query( $conn, "SELECT * FROM pesanan WHERE id_pesanan = '$_SESSION[id_pesanan]'");
    $pesan = [];
    while ($row = mysqli_fetch_array($result)) {
        $pesan[] = $row;
    }
    foreach ($pesan as $data_pesanan);

    if ($data_pesanan['status'] != 'menunggu'){
        header("Location: hasil_pesanan.php");
        return;
    }

    $username = $_SESSION["username"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $data = [];
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    foreach ($data as $user);
    $id_user = $user["id_user"];

    $result = mysqli_query( $conn, "SELECT * FROM produk WHERE id_produk = '$data_pesanan[id_produk]'");
    $data_produk = [];
    while ($row = mysqli_fetch_array($result)) {
        $data_produk[] = $row;
    }
    foreach ($data_produk as $produk);

    if (isset($_POST["lanjutkan"])){
        $jumlah = $_POST["jumlah"];
        header("Location: edit_pembayaran.php?id=$jumlah");
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/AZ.ico">
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
                    <li> <a href="../pengguna/user/user.php"> HOME </a></li>
                    <li> <a href="../produk/list_barang.php"> PRODUCT </a></li>
                    <li> <a href='pesanan_user.php' style="color: #fa022e;"> ORDER </a></li>
                    <li> <a href='../pengguna/user/profile.php?id=<?php echo $id_user; ?>'> PROFILE </a></li>
                    <li> <a href="../logout.php"> LOGOUT </a></li>
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
                <h2>Form Tambah Data Pesanan</h2>
                <div class="order-detail">
                    <div class="input">
                        <span class="detail"> Username </span>
                        <input name="nama" type="text" value="<?php echo ucwords($user['username']) ?>" readonly 
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Nomor HP </span>
                        <input  name="no_hp" type="text" value="<?php echo $user['no_hp'] ?>" readonly 
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Nama HP </span>
                        <input name="merk" type="text" value="<?php echo $produk['nama'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Jumlah Pesanan </span>
                        <input name="jumlah" type="number" min="1" required value="<?php echo $data_pesanan['jumlah'] ?>"
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="submitButton">
                        <input type="submit" value="Selanjutnya" name="lanjutkan">
                    </div>
                    <div class="kelola">
                        <button><a href="pesanan_user.php">Kembali</a> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../scriptorder.js"></script>
</body>
</html>
