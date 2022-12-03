<?php 
    session_start();
    if ($_SESSION["priv"] != "admin") {
        header("Location: ../../login.php");
    }
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
    <link rel="stylesheet" href="../../style_footer.css">
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
                    <li> <a href="" style="color: #fa022e;"> DASHBOARD </a></li>
                    <li> <a href="messages.php" > MESSAGES </a></li>
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
        <div class="kelola">
            <h1> Kelola Database AnharZtore </h1>
            <div class="kelola-detail">
                <button> <a href="kelola-pesanan.php"> Kelola Data Pesanan </a> </button>
                <button> <a href="kelola-barang.php"> Kelola Data Barang </a> </button>
            </div>
        </div>
    </div>
    <script src="../../scriptabout.js"></script>
</body>
</html>
