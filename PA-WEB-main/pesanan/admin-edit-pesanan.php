<?php
    session_start();
    if ($_SESSION["priv"] != "admin") {
        header("Location: ../login.php");
    }

    require '../koneksi.php';

    $id = $_GET['id'];
    $result = mysqli_query( $conn, "SELECT * FROM pesanan
                            INNER JOIN user ON pesanan.id_user = user.id_user
                            INNER JOIN produk ON pesanan.id_produk = produk.id_produk
                            WHERE id_pesanan = '$id'"
                            );
    $pesanan = [];
    while ($row = mysqli_fetch_array($result)) {
        $pesanan[] = $row;
    }
    foreach($pesanan as $pesan);

    if (isset($_POST["ubah"])) {
        $id = $_GET['id'];
        $status = $_POST["status"];
        if ($status != $pesan['status']){
            if ($status == "berhasil"){
                $result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $pesan[id_produk]");
                $data_produk = [];
                while($row = mysqli_fetch_array($result)){
                    $data_produk[] = $row;
                }
                foreach ($data_produk as $produk);
                if ($pesan['jumlah'] <= $produk['stock']){
                    $stock_terbaru = $produk['stock'] - $pesan['jumlah'];
                    $result = mysqli_query($conn, "UPDATE produk SET stock = $stock_terbaru WHERE id_produk = $pesan[id_produk]");
                }
            }
            $sql = "UPDATE pesanan SET `status` = '$status' WHERE id_pesanan = '$id'";
            $result = mysqli_query($conn, $sql);
            if ( $result ) {
                echo"
                    <script>
                        alert('Data berhasil diubah');
                        document.location.href = '../pengguna/admin/kelola-pesanan.php';
                    </script>
                ";
            }else{
                echo"
                    <script>
                        alert('Data gagal diubah');
                        document.location.href = '../pengguna/admin/kelola-pesanan.php';
                    </script>
                ";
            }
        }
        else {
            echo"
                <script>
                    document.location.href = '../pengguna/admin/kelola-pesanan.php';
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
                    <li> <a href="../pengguna/admin/admin.php"> HOME </a></li>
                    <li> <a href="../produk/admin_list_barang.php"> PRODUCT </a></li>
                    <li> <a href="../pengguna/admin/kelola.php" style="color: #fa022e"> DASHBOARD </a></li>
                    <li> <a href="../pengguna/admin/messages.php"> MESSAGES </a></li>
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
                <h2>Form Update Data Pesanan</h2>
                <div class="order-detail">
                    <div class="input">
                        <span class="detail"> Username </span>
                        <input name="nama" type="text" value="<?php echo ucwords($pesan['username']) ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Nomor HP </span>
                        <input name="no_hp" type="tel" value="<?php echo $pesan['no_hp'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Merk HP </span>
                        <input name="merk" type="text" value="<?php echo $pesan['nama'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Jumlah Order </span>
                        <input name="jumlah" type="number" value="<?php echo $pesan['jumlah'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Total Harga </span>
                        <input name="total" type="text" value="Rp <?php echo number_format($pesan['total_harga'], 0, '.', '.') ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail"> Alamat </span>
                        <input name="alamat" type="text" value="<?php echo $pesan['alamat'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail">Pembayaran </span>
                        <input name="pembayaran" type="text" value="<?php echo $pesan['metode_pembayaran'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail">Atas Nama </span>
                        <input name="atas_nama" type="text" value="<?php echo $pesan['atas_nama'] ?>" readonly
                                style="
                                    box-shadow: 0px 0px 5px 0px rgb(255, 172, 254);
                                    border-color: rgb(198, 72, 37);">
                    </div>
                    <div class="input">
                        <span class="detail">Status </span>
                        <select name="status" id="" required>
                        <?php 
                        if ($pesan['status'] != 'menunggu'){
                            $status = ucwords($pesan['status']);
                            echo "<option value='$pesan[status]' readonly >$status</option>";
                        }else {
                            echo "<option value=''>-</option>";
                            echo "<option value='menunggu'>Menunggu</option>";
                            echo "<option value='berhasil'>Berhasil</option>";
                            echo "<option value='gagal'>Gagal</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="submitButton">
                        <input type="submit" value="Submit" name="ubah">
                    </div>
                    <div class="kelola">
                        <button><a href="../pengguna/admin/kelola-pesanan.php">Kembali</a> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../scriptorder.js"></script>
</body>
</html>
