<?php 
    session_start();
    require "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/AZ.ico">
    <title>AnharZtore</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="atas" style="height: 130vh;">
        <a href="#" id="logo"> Anhar <font color="#f86909"> Ztore </font> </a>
        <div class="login" style="margin-top: 100px"> 
            <div class="title">
                <h1> REGISTRASI </h1>
                <form action="" class="formLogin" method="post">
                    <div class="input">
                        <input class="text" type="text" maxlength="30" name="username" required>
                        <span></span>
                        <label>Username</label>
                    </div>
                    <div class="input">
                        <input class="text" type="password" maxlength="50" name="password" required>
                        <span></span>
                        <label>Password</label>
                    </div>
                    <div class="input">
                        <input class="text" type="password" maxlength="50" name="cpassword" required>
                        <span></span>
                        <label>Konfirmasi Password</label>
                    </div>
                    <div class="input">
                        <input class="text" type="email" maxlength="50" name="email" required>
                        <span></span>
                        <label>Email</label>
                    </div>
                    <div class="input">
                        <input class="text" type="text" maxlength="50" name="no_hp" required>
                        <span></span>
                        <label>Nomor Hp</label>
                    </div>
                    <div class="input">
                        <input class="text" type="text" maxlength="50" name="alamat" required>
                        <span></span>
                        <label>Alamat</label>
                    </div>
                    <input type="submit" value="REGISTRASI" class="submit" name="submit">
                </form>
                <div class="guess">
                    <a href="login.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <?php
        if (isset($_POST['submit'])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            $email = $_POST["email"];
            $no_hp = $_POST["no_hp"];
            $alamat = $_POST["alamat"];

            if ($password === $cpassword){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $result = mysqli_query($conn, "SELECT username from user where username = '$username'");
                
                if (mysqli_fetch_assoc($result)){
                    echo "<script>
                        alert('Username Telah Digunakan, Silahkan Gunakan Username Yang Lain');
                    </script>";
                } else {
                    $result = mysqli_query($conn, " INSERT INTO user 
                                                    VALUES ('', 
                                                            'user', 
                                                            '$username',
                                                            '$password',
                                                            '$email',
                                                            '$no_hp',
                                                            '$alamat')");
                    if (mysqli_affected_rows($conn) > 0){
                        echo "<script>
                            alert('Registrasi Berhasil');
                            document.location.href = 'login.php';
                        </script>";
                    } else {
                        echo "<script>
                            alert('Registrasi Gagal');
                        </script>";
                    }
                }
            } else {
                echo "<script>
                    alert('Konfirmasi Password Tidak Sesuai');
                </script>";
            }

        }
        
    ?> 
    <script src="scriptlogin.js"></script>
</body>
</html>
