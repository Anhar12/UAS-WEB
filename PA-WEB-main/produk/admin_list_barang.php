<?php
session_start();
require '../koneksi.php';
if ($_SESSION["priv"] != "admin") {
  header("Location: ../login.php");
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
  <link rel="stylesheet" href="../style_footer.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!-- header -->
  <div class="atas" >
    <nav>
      <a href="index.php" id="logo"> Anhar <font color="#f86909"> Ztore </font> </a>
      <div class="navbar">
        <ul>
          <li> <a href="../pengguna/admin/admin.php"> HOME </a></li>
          <li> <a href="" style="color: #fa022e;"> PRODUCT </a></li>
          <li> <a href="../pengguna/admin/kelola.php"> DASHBOARD </a></li>
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
    <div class="container" id="product">
      <h1> Produk AnharZtore </h1>
      <p class="best-seller" style="color: #eeeeee;"> Berbagai macam produk smarthphone dengan berbagai variasi harga yang pastinya murah meriah, aman di kantong, dan pastinya amanah, serta istiqomah </p>
      <form action="" method="GET" style="margin: 20px 0;">
            <div class="search" style="width: 94%; margin-left: 3%;">
                <input type="text" placeholder="Cari produk yang anda inginkan" maxlength="50" class="anu_search" name="cari" style="color: #ffffff;">
                <button type="submit" name="search" class="searching">Search</button>
            </div>
      </form>
      <div  class="box-produk">
        <?php
        if (isset($_GET["search"])) {
          $keyword = $_GET["cari"];
          $result = mysqli_query($conn, "SELECT * FROM produk WHERE
                    nama LIKE '%$keyword%' OR
                    harga LIKE '%$keyword%'");
          if (mysqli_num_rows($result) === 0){
            echo "<p
              style='
                  color: #ffffff;
                  font-size: 24px;
                  width: 100%;
              '> 
              Oops, Produk Tidak Ditemukan </p>";
          }
        }
        else {
          $result = mysqli_query($conn, "SELECT * FROM produk");
        }
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='produk'>";
            echo "<a href='../detail-produk.php?id=$row[id_produk]'><img src='../img/$row[gambar]' alt='Gambar Produk'></a>";
            echo "<div class='deskripsi-produk'>";
              echo "<a href='../detail-produk.php?id=$row[id_produk]'><h4 class='judul' style='color: #ffffff;'>$row[nama]</h4></a>";
              $harga = number_format($row['harga'],0,'.','.');
              echo "<div class='bagianBawah'>";
                echo "<p class='harga'>Rp $harga</p>";
                echo "<a href='../cek_login.php?id=$row[id_produk]' class='btn-produk'>Beli Sekarang</a>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        }
        ?>
      </div>
    </div>
  </div>
  
  <!-- footer -->
  <?php include '../footer.php'; ?>
  
  <script src="../scriptidx.js"></script>
</body>

</html>
