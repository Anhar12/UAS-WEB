<?php
    session_start();
    if ($_SESSION["priv"] != "user") {
        header("Location: ../login.php");
    }
    
    require '../koneksi.php';

    $username = $_SESSION["username"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $data = [];
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    foreach ($data as $user);
    $id_user = $user["id_user"];

    $result = mysqli_query( $conn, "SELECT * FROM pesanan WHERE id_pesanan = '$_SESSION[id_pesanan]'");
    $data_pesanan = [];
    while ($row = mysqli_fetch_array($result)) {
        $data_pesanan[] = $row;
    }
    foreach ($data_pesanan as $pesanan);

    $id_produk = $pesanan["id_produk"];
    $result = mysqli_query( $conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $data_produk = [];
    while ($row = mysqli_fetch_array($result)) {
        $data_produk[] = $row;
    }
    foreach ($data_produk as $produk);

    $jumlah = $_GET["id"];
    $total = $produk["harga"] * $jumlah;

    if (isset($_POST["tambah"])) {
        date_default_timezone_set("asia/kuala_lumpur");
        $id_pesanan = $_SESSION["id_pesanan"];
        $id_user = $user["id_user"];
        $id_produk = $produk["id_produk"];
        $metode_pembayaran = $_POST["metode_pembayaran"];
        $jumlah = $jumlah;
        $total_harga = $total;
        $waktu = date("y-m-d h:i:s");
        $atas_nama = $_POST["atas_nama"];
        $status = "menunggu";

        $sql = "UPDATE pesanan SET 
                id_user = '$id_user', 
                id_produk = '$id_produk', 
                metode_pembayaran = '$metode_pembayaran', 
                jumlah = '$jumlah', 
                total_harga = '$total_harga', 
                keterangan_waktu = '$waktu', 
                atas_nama = '$atas_nama', 
                `status` = '$status'
                WHERE id_pesanan = '$id_pesanan'";

        $result = mysqli_query($conn, $sql);
        if ( $result ) {
            echo"
                <script>
                    alert('Pesanan berhasil diubah');
                    document.location.href = 'pesanan_user.php';
                </script>
            ";
        }else{
            echo"
                <script>
                    alert('Pesanan gagal diubah');
                    document.location.href = 'pesanan_user.php';
                </script>
            ";
        }
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
                <h2>Form Konfirmasi Data Pesanan</h2>
                <div class="order-detail">
                    <div class="input">
                        <span class="detail"> Total Harga </span>
                        <input name="total" type="text" value="Rp <?php echo number_format($total, 0, '.', '.') ?>" min="0" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Alamat </span>
                        <input name="alamat" type="text" value="<?php echo $user['alamat'] ?>" readonly 
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Pembayaran </span>
                        <select name="metode_pembayaran" id="" required
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                            <option value="<?php echo $pesanan['metode_pembayaran'] ?>" >
                                    <?php echo $pesanan['metode_pembayaran'] ?>
                            </option>
                            <option value="Bank Mandiri">Bank Mandiri</option>
                            <option value="Bank BCA">Bank BCA</option>
                            <option value="Bank BNI">Bank BNI</option>
                            <option value="DANA">DANA</option>
                            <option value="GOPAY">GOPAY</option>
                        </select>
                    </div>
                    <div class="input">
                        <span class="detail"> Atas Nama </span>
                        <input  name="atas_nama" type="text" required value="<?php echo $pesanan['atas_nama'] ?>"
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="submitButton">
                        <input type="submit" value="Submit" name="tambah">
                    </div>
                    <div class="kelola">
                        <button><a href="edit_pesanan_user.php?id=<?php echo $pesanan['id_pesanan']; ?>">Kembali</a> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../scriptorder.js"></script>
</body>
</html>
