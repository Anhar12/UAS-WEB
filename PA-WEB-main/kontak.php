<?php
session_start();
require 'koneksi.php';
if ($_SESSION["priv"] != "admin" and $_SESSION["priv"] != "user"){
    header("Location: index.php?id=$_GET[id]");
    return;
}
if (isset($_SESSION["username"])){
  $username = $_SESSION["username"];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
  $data = [];
  while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
  }
  foreach ($data as $user);
  $id = $user["id_user"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/AZ.ico">
    <title>AnharZtore</title>
    <link rel="stylesheet" href="style-detail-produk.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .contact input{
      width: 100px;
      height:50px;
    }

    .contact .row{
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap:1.5rem;
    }

    .contact .row .image{
      flex:0 1 50%;
    }

    .contact .row .image img{
      width: 70%;
      padding-left:20%;
    }

    .contact .row form{
      border: 0.2rem solid #222;
      flex: 0 1 30%;
      padding: 0.5rem 2rem;
      text-align: center;
      background-color:#fff;
    }

    .contact .row form h3{
      font-size: 2.5rem;
      color:#222;
      margin-bottom: 1rem;
      text-transform: capitalize;
    }

    .contact .row form .box{
      margin: 0.7rem 0;
      font-size: 1rem;
      color: #222;
      border: 0.2rem solid #222;
      padding: 0.5rem;
      width: 90%;
      height: 5%;
    }

    .contact .row form textarea{
      height: 7rem;
      resize: none;
    }

    .btn{
      background-color: #f86909;
      color:#222;
    }
    @media (max-width: 745px){
      .contact .row .image img{
        width: 100%;
        padding: 0;
      }
    }
    </style>
  </head>

<body>
    <!-- header -->
    <div class="atas">
        <nav>
            <a href="index.php" id="logo"> Anhar <font color="#f86909"> Ztore </font> </a>
            <div class="navbar">
                <ul>
                <?php 
                    $username = $_SESSION["username"];
                    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
                    $data = [];
                    while ($row = mysqli_fetch_array($result)) {
                        $data[] = $row;
                    }
                    foreach ($data as $user);
                    $id = $user["id_user"];
                    echo "<li> <a href='pengguna/user/user.php'> HOME </a></li>";
                    echo "<li> <a href='produk/list_barang.php' '> PRODUCT </a></li>";
                    echo "<li> <a href='pesanan/pesanan_user.php'> ORDER </a></li>";
                    echo "<li> <a href='kontak.php' style='color: #FA022E;'> CONTACT </a></li>";
                    echo "<li> <a href='pengguna/user/profile.php?id= $id'> PROFILE </a></li>";
                    echo "<li> <a href='logout.php'> LOGOUT </a></li>";

                ?>  
                    <li>
                        <label>
                            <input type="checkbox" class="checkbox" id="tombol">
                            <span class="check"></span>
                        </label>
                    </li>
                </ul>
            </div>
        </nav> 
        <!-- formulir kontak -->
    <section class="contact">

      <div class="row">

          <div class="image">
            <img src="img/Contact us-pana.svg" alt="">
          </div>

          <form action="" method="post">
            <h3>tell us something!</h3>
            <input type="text" name="name" maxlength="50" style="font-weight: 600;" class="box" value="<?php echo ucwords($user['username']) ?>" required readonly>
            <input type="email" name="email" maxlength="50" style="font-weight: 600;" class="box" value="<?php echo ucwords($user['email']) ?>" required readonly>
            <textarea name="msg" class="box" style="font-weight: 600;" required placeholder="Enter your message" maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" style="cursor: pointer; font-size: 16px; width: 120px; font-weight: 600;" value="Send Message" name="send" class="btn">
          </form>

      </div>

      </section> 
    </div>

<?php

if(isset($_POST['send'])){

    $nama = $_POST['name'];
    // $nama = filter_var($nama, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    // $email = filter_var($email, FILTER_SANITIZE_STRING);
    $saran = $_POST['msg'];
    // $saran = filter_var($saran, FILTER_SANITIZE_STRING);

    $result = mysqli_query($conn, "INSERT INTO saran VALUES('','$id','$nama','$email','$saran')");
    
    if ( $result ) {
      echo"
        <script>
          alert('Saran berhasil ditambah');
          document.location.href = 'kontak.php';
        </script>
      ";
    }else{
      echo"
        <script>
          alert('Saran gagal ditambah');
          document.location.href = 'kontak.php';
        </script>
      ";
    }
}
?>
    <script src="scriptidx.js"></script>
</body>

</html>
