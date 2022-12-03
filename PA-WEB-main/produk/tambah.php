<?php
    session_start();
    if ($_SESSION["priv"] != "admin") {
        header("Location: ../login.php");
    }

    require '../koneksi.php';

    if (isset($_POST["tambah"])) {
        date_default_timezone_set("asia/kuala_lumpur");
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $kategori = $_POST["kategori"];
        $deskripsi = $_POST["deskripsi"];
        $stock = $_POST["stock"];
        $waktu = date("y-m-d h:i:s");
        $gambar = $_FILES["gambar"]["name"];
        $gambarBaru = "$nama.png";
        $tmp = $_FILES["gambar"]["tmp_name"];
        
        if(move_uploaded_file($tmp, '../img/' . $gambarBaru)){
            $sql = "INSERT INTO produk 
                    VALUES ('', 
                            '$nama', 
                            '$harga', 
                            '$kategori', 
                            '$deskripsi', 
                            '$stock', 
                            '$waktu', 
                            '$gambarBaru')";
            $result = mysqli_query($conn, $sql);
            if ( $result ) {
                echo"
                    <script>
                        alert('Data berhasil ditambah');
                        document.location.href = '../pengguna/admin/kelola-barang.php';
                    </script>
                ";
            }else{
                echo"
                    <script>
                        alert('Data gagal ditambah');
                        document.location.href = '../pengguna/admin/kelola-barang.php';
                    </script>
                ";
            }
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
                    <li> <a href="admin_list_barang.php"> PRODUCT </a></li>
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
            <form method="post" action="" enctype="multipart/form-data">
                <h2>Form Tambah Data Barang</h2>
                <div class="order-detail">
                    <div class="input">
                        <span class="detail">Nama</span>
                        <input name="nama" type="text" placeholder="Samsung Galaxy A71" required>
                    </div>
                    <div class="input">
                        <span class="detail">Kategori</span>
                        <input name="kategori" type="text" placeholder="Tingkat Menengah" required>
                    </div>
                    <div class="input">
                        <span class="detail">Harga</span>
                        <input name="harga" type="text" placeholder="2000000" required>
                    </div>
                    <div class="input">
                        <span class="detail">Stock</span>
                        <input name="stock" type="text" placeholder="17" required>
                    </div>
                    <div class="input">
                        <span class="detail">Gambar</span>
                        <input name="gambar" type="file" required>
                    </div>
                    <div class="input">
                        <span class="detail">Deskripsi</span>
                        <textarea name="deskripsi" id="" cols="30" rows="10" placeholder="Ram 4GB"></textarea>
                    </div>
                    <div class="submitButton">
                        <input type="submit" value="Submit" name="tambah">
                    </div>
                    <div class="kelola">
                        <button><a href="../pengguna/admin/kelola-barang.php">Kembali</a> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../scriptorder.js"></script>
</body>
</html>
