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
    <div class="atas">
        <a href="index.php" id="logo"> Anhar <font color="#f86909"> Ztore </font> </a>
        <div class="login"> 
            <div class="title">
                <h1> LOGIN </h1>
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
                    <input type="submit" value="LOGIN" class="submit" name="submit">
                    <div class="guess">
                        Tidak Punya Akun? <a href="regis.php"> Register </a>
                    </div>
                    <div class="guess">
                        <a href="index.php">Kembali</a>
                    </div>
                </form>
            </div>
            
        </div>
    </div>

    <?php
        if (isset($_POST['submit'])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

            if (mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                if (password_verify($password, $row['password']) && $username == $row['username']){
                    if ($row['role'] == 'admin'){
                        $_SESSION["priv"] = "admin";
                        header("Location: pengguna/admin/admin.php");
                        exit;
                    } 
                    if ($row['role'] == 'user') {
                        $_SESSION["priv"] = "user";
                        $_SESSION["username"] = $username;
                        $_SESSION["password"] = $password;
                        header("Location: pengguna/user/user.php");
                        exit;
                    }
                } else {
                    echo "<script>
                        alert('username atau password salah');
                    </script>";
                }
            }
            else {
                echo "<script>
                    alert('username atau password salah');
                </script>";
            }
        }
    ?> 
    <script src="scriptlogin.js"></script>
</body>
</html>
