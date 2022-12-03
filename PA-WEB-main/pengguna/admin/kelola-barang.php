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
            <h1> Kelola Data Produk AnharZtore </h1>
            <form action="" class="search_barang" method="GET">
                <div class="btn-kelola">
                    <button> <a href="kelola.php">Kembali</a> </button>
                    <button style="width: 150px"> <a href="../../produk/tambah.php">Tambah Produk</a> </button>
                </div>
                <div class="search" style="width: 45%;">
                    <input type="text" placeholder="Cari data yang anda inginkan" maxlength="50" class="anu_search" name="cari" style="color: #ffffff;">
                    <button type="submit" name="search" class="searching">Search</button>
                </div>
            </form>
            <table border="1">
                <tr height="50px">
                    <th> No </th>
                    <th> Nama </th>
                    <th> Gambar </th>
                    <th> Stok </th>
                    <th> Harga </th>
                    <th> Kategori </th>
                    <th> Deskripsi </th>
                    <th> Waktu Ditambahkan </th>
                    <th colspan="2"> Kelola </th>
                </tr>
                <?php 
                    if (isset($_GET["search"])) {
                        $keyword = $_GET["cari"];
                        $result = mysqli_query($conn, "SELECT * FROM produk WHERE
                                nama LIKE '%$keyword%' OR
                                harga LIKE '%$keyword%' OR
                                kategori LIKE '%$keyword%' OR
                                deskripsi LIKE '%$keyword%' OR
                                stock LIKE '%$keyword%'");
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
                        $result = mysqli_query($conn, "SELECT * FROM produk");
                    }
                    $barang = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $barang[] = $row;
                    }
                    $i = 1; 
                    foreach ($barang as $brg):
                ?>
                <tr>
                    <td> <?php echo $i ;?> </td>
                    <td> <?php echo $brg['nama'] ;?> </td>
                    <td> <img src="../../img/<?php echo $brg['gambar']; ?>" id="gmbr_tbl" alt="Gambar Produk"></td>
                    <td> <?php echo $brg['stock'] ;?> </td>
                    <td width="11%"> <?php echo 'Rp '.number_format($brg['harga'], 0, '.', '.');?> </td>
                    <td> <?php echo $brg['kategori'] ;?> </td>
                    <td style="text-align: justify;"> <?php echo $brg['deskripsi'] ;?> </td>
                    <td width="10%"> <?php echo $brg['keterangan'] ;?> </td>
                    <td width="5%"> <a href="../../produk/editbrg.php?id=<?php echo $brg['id_produk']; ?>" class="updt"> <i class="material-icons" style="font-size:26px;color:green">update</i> </td> </a>
                    <td width="5%"> <a href="../../produk/hapusbrg.php?id=<?php echo $brg['id_produk']; ?>" class = "dlt"> <i class="material-icons" style="font-size:26px;color:red">delete</i> </a> </td>
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
