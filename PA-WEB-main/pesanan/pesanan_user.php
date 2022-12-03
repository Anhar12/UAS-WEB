<?php
    session_start();
    if ($_SESSION["priv"] != "user") {
        header("Location: ../login.php");
    }
    
    require "../koneksi.php";
    $username = $_SESSION["username"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $data = [];
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    foreach ($data as $user);
    $id = $user["id_user"];
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .boxPesanan {
            padding-top: 20px;
            margin: auto;
            width: 90%;
            display: flex;
            flex-wrap: wrap;
        }
        .pesanan {
            margin: auto;
            margin-bottom: 30px;
            width: 29%;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            color: #ffffff;
            border-radius: 13px;
        }
        .deskripsi {
            margin: 0;
            margin-left: 10px;
            display: flex;
            text-align: left;
            flex-direction: column;
        }
        .pesanan p {
            padding: 0;
            margin-bottom: 3px;
            font-weight: 400;
            border: 1px solid transparent;
        }
        .action {
            margin-top: 5px;
            display: flex;
            justify-content: space-between;
        }
        .action button {
            cursor: pointer;
            transition: all 0.3s;
            margin: 0;
            width: 47%;
            padding: 0;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(3px);
            color: #ffffff;
        }
        .pesanan .status {
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 1px;
            margin-top: 5px;
            padding-top: 2px;
            padding-bottom: 5px;
            border: 1px solid transparent;
            border-radius: 8px; 
            text-align: center;
        }
    </style>
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
                    <li> <a href="" style="color: #fa022e;"> ORDER </a></li>
                    <li> <a href='../kontak.php?id=<?php echo $id ?>'> CONTACT </a></li>
                    <li> <a href="../pengguna/user/profile.php?id=<?php echo $id; ?>"> PROFILE </a></li>
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
        <div class="crud">
            <h1> Daftar Pesanan Anda </h1>
            <div class="btn-kelola">
                <button><a href="../pengguna/user/user.php">Kembali</a> </button>
                <button><a href="../produk/list_barang.php">Tambah</a> </button>
            </div>
            
            <div class="boxPesanan">
                <?php 
                    // $cekPesanan = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_user = ")
                    $result = mysqli_query($conn, 
                                "SELECT * FROM pesanan 
                                INNER JOIN user ON pesanan.id_user = user.id_user
                                INNER JOIN produk ON pesanan.id_produk = produk.id_produk
                                WHERE pesanan.id_user = '$id'");
                    if (mysqli_num_rows($result) === 0){
                        echo "<p
                        style='
                            color: #ffffff;
                            font-size: 24px;
                            width: 100%;
                        '> 
                        Tidak Ada Pesanan </p>";
                    }
                    else {
                        $pesanan = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $pesanan[] = $row;
                        }
                        foreach ($pesanan as $pesan):
                ?>
                <div class="pesanan">
                    <img src="../img/<?php echo $pesan['gambar'];?>" alt="Gambar Produk">
                    <div class="deskripsi">
                        <p style="font-weight: 600;"><?php echo ucwords($pesan['nama']);?></p>
                        <p>Jumlah : <?php echo $pesan['jumlah'];?></p>
                        <p>Total Harga</p>
                        <p style="font-weight: 600;">Rp <?php echo number_format($pesan['total_harga'], 0, ".", ".") ?></p>
                        <?php 
                            $status = ucwords($pesan['status']);
                            if ($pesan['status'] == "berhasil"){
                                echo "<p class='status'
                                style='
                                    width: 90px;
                                    background: #28a745;'
                                >$status</p>";
                            }
                            else if ($pesan['status'] == "gagal"){
                                echo "<p class='status'
                                style='
                                    width: 70px;
                                    background: #dc3545;'
                                >$status</p>";
                            }
                            else {
                                echo "<p class='status' 
                                style='
                                    width: 105px;
                                    background: #ffc107;
                                    color: #000000;'
                                >$status</p>";
                            }
                        ?>
                        <div class="action">
                            <button>
                                <a href="../pesanan/edit_pesanan_user.php?id=<?php echo $pesan['id_pesanan']; ?>" 
                                class="updt"> 
                                    <i class="material-icons" 
                                    style=" padding: 0; 
                                            font-size:32px;
                                            color:green;
                                            margin-top: 2px"
                                    >update</i>
                                </a>
                            </button>
                            <button>
                                <a href="../pesanan/hapus.php?id=<?php echo $pesan['id_pesanan']; ?>" 
                                    class="dlt"> 
                                    <i class="material-icons" 
                                    style=" padding: 0; 
                                            font-size:32px;
                                            color:red;
                                            margin-top: 2px"
                                    >delete</i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                    <?php 
                        endforeach;
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="../scriptabout.js"></script>
</body>
</html>
