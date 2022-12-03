
<?php
    session_start();
    if ($_SESSION["priv"] != "user") {
        header("Location: ../../login.php");
    }
    require '../../koneksi.php';
    $password = $_SESSION["password"];
    $id = $_GET['id'];
    
    if (isset($_POST["ubah"])) {
        $id = $_GET['id'];
        $usernameLama = strtolower($_SESSION["username"]);
        $username = strtolower($_POST["username"]);
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $no_hp = $_POST["no_hp"];
        $alamat = $_POST["alamat"];

        $sql = "";
        if ($username == $usernameLama){
            $sql = "UPDATE user SET
                    `role` = 'user', 
                    `password` = '$password', 
                    email = '$email', 
                    no_hp = '$no_hp', 
                    alamat = '$alamat'
                    WHERE id_user = '$id'";
        }
        else {
            $result = mysqli_query($conn, "SELECT username from user where username = '$username'");
            if (mysqli_fetch_assoc($result)){
                echo "
                    <script>
                        alert('Username Telah Digunakan, Silahkan gunakan Username yang lain');
                        document.location.href = 'user.php';
                    </script>";
            } else {
                $sql = "UPDATE user SET 
                        `role` = 'user', 
                        username = '$username',
                        `password` = '$password', 
                        email = '$email', 
                        no_hp = '$no_hp', 
                        alamat = '$alamat'
                        WHERE id_user = '$id'";
            }
        }
        $result = mysqli_query($conn, $sql);
        if ( $result ) {
            $_SESSION["username"] = $username;
            echo"
                <script>
                    alert('Data berhasil diubah');
                    document.location.href = 'user.php';
                </script>
            ";
        }else{
            echo"
                <script>
                    alert('Data gagal diubah');
                    document.location.href = 'user.php';
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
    <link rel="icon" href="../../assets/AZ.ico">
    <title>AnharZtore</title>
    <link rel="stylesheet" href="../../style.css">
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
                    <li> <a href="../../produk/list_barang.php"> PRODUCT </a></li>
                    <li> <a href="../../pesanan/pesanan_user.php"> ORDER </a></li>
                    <li> <a href="../../kontak.php?id=<?php echo $id; ?>"> CONTACT </a></li>
                    <li> <a href="" style="color: #fa022e;"> PROFILE </a></li>
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
    <div class="form">
            <form method="POST" action="" enctype="multipart/form-data">
                <h2>Data Profile User</h2>
                <div class="order-detail">
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id'");
                        $data = [];
                        while ($row = mysqli_fetch_array($result)) {
                            $data[] = $row;
                        }
                        foreach ($data as $user):
                    ?>
                    <div class="input">
                        <span class="detail">Username</span>
                        <input name="username" type="text" value="<?php echo ucwords($user['username'])?>" required>
                    </div>
                    <div class="input">
                        <span class="detail">Password</span>
                        <input name="password" type="text" value="<?php echo $password?>" required>
                    </div>
                    <div class="input">
                        <span class="detail">Email</span>
                        <input name="email" type="text" value="<?php echo $user['email']?>" required>
                    </div>
                    <div class="input">
                        <span class="detail">No Telepon</span>
                        <input name="no_hp" type="text" value="<?php echo $user['no_hp']?>" required>
                    </div>
                    <div class="input">
                        <span class="detail">Alamat</span>
                        <textarea name="alamat" id="" cols="30" rows="10" ><?php echo $user['alamat'] ?></textarea>
                    </div>
                    <div class="submitButton">
                        <input type="submit" value="Submit" name="ubah">
                    </div>
                    <div class="kelola">
                        <button><a href="user.php">Kembali</a> </button>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </form>
        </div>
    </div>
    <script src="../../scriptabout.js"></script>
</body>
</html>
