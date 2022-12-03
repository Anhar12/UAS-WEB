<?php
    session_start();
    if ($_SESSION["priv"] != "admin") {
        header("Location: ../../login.php");
    }
    
    require "../../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/AZ.ico">
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
                    <li> <a href="admin.php"> HOME </a></li>
                    <li> <a href="../../produk/admin_list_barang.php"> PRODUCT </a></li>
                    <li> <a href="kelola.php" style="color: #fa022e;"> DASHBOARD </a></li>
                    <li> <a href="messages.php"> MESSAGES </a></li>
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
            <h1> Kelola Data Pesanan AnharZtore </h1>
            <form action="" class="search_barang" method="GET">
                <div class="btn-kelola">
                    <button> <a href="kelola.php">Kembali</a> </button>
                </div>
                <div class="search" style="width: 45%;">
                    <input type="text" placeholder="Cari data yang anda inginkan" maxlength="50" class="anu_search" name="cari" style="color: #ffffff;">
                    <button type="submit" name="search" class="searching">Search</button>
                </div>
            </form>
            <table border="1">
                <tr height="50px">
                    <th> No. </th>
                    <th> Nama </th>
                    <th> No. Telp </th>
                    <th> Nama HP </th>
                    <th> Jumlah </th>
                    <th> Alamat </th>
                    <th> Pembayaran </th>
                    <th> Atas Nama </th>
                    <th> Keterangan </th>
                    <th> Status </th>
                    <th colspan="2"> Kelola </th>
                </tr>
                <?php 
                    if (isset($_GET["search"])) {
                        $keyword = $_GET["cari"];
                        $result =   mysqli_query( 
                                    $conn, "SELECT * FROM pesanan 
                                            INNER JOIN user ON pesanan.id_user = user.id_user
                                            INNER JOIN produk ON pesanan.id_produk = produk.id_produk
                                            WHERE   user.username LIKE '%$keyword%' OR
                                                    user.no_hp LIKE '%$keyword%' OR
                                                    produk.nama LIKE '%$keyword%' OR
                                                    jumlah LIKE '%$keyword%' OR
                                                    user.alamat LIKE '%$keyword%' OR
                                                    metode_pembayaran LIKE '%$keyword%' OR
                                                    atas_nama LIKE '%$keyword%' OR
                                                    `status` LIKE '%$keyword%'");
                        if (mysqli_num_rows($result) === 0){
                            echo "<p
                                style='
                                    color: #ffffff;
                                    font-size: 24px;
                                    width: 100%;
                                '> 
                                Oops, Data Tidak Ditemukan </p>";
                            }
                    }
                    else {
                        $result = mysqli_query( 
                                    $conn, "SELECT * FROM pesanan 
                                            INNER JOIN user ON pesanan.id_user = user.id_user
                                            INNER JOIN produk ON pesanan.id_produk = produk.id_produk");
                    }
                    $pesanan = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $pesanan[] = $row;
                    }
                    $i = 1; 
                    foreach ($pesanan as $pesan):
                ?>
                <tr>
                    <td> <?php echo $i ;?> </td>
                    <td> <?php echo ucwords($pesan['username']) ;?> </td>
                    <td> <?php echo $pesan['no_hp'] ;?> </td>
                    <td> <?php echo $pesan['nama'] ;?> </td>
                    <td> <?php echo $pesan['jumlah'] ;?> </td>
                    <td> <?php echo $pesan['alamat'] ;?> </td>
                    <td> <?php echo $pesan['metode_pembayaran'] ;?> </td>
                    <td> <?php echo $pesan['atas_nama'] ;?> </td>
                    <td> <?php echo $pesan['keterangan_waktu'] ;?> </td>
                    <td> <?php echo ucwords($pesan['status']) ;?> </td>
                    <td width="4%"> <a href="../../pesanan/admin-edit-pesanan.php?id=<?php echo $pesan['id_pesanan']; ?>" class="updt"> <i class="material-icons" style="font-size:26px;color:green">update</i> </td> </a>
                    <td width="4%"> <a href="../../pesanan/hapus.php?id=<?php echo $pesan['id_pesanan']; ?>" class = "dlt"> <i class="material-icons" style="font-size:26px;color:red">delete</i> </a> </td>
                </tr>
                <?php 
                    $i++; 
                    endforeach;
                ?>
            </table>
        </div>
    </div>    
    <script src="../../scriptabout.js"></script>
</body>
</html>
