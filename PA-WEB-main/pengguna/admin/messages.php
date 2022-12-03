<?php
session_start();
if ($_SESSION["priv"] != "admin") {
  header("Location: ../../login.php");
}
require "../../koneksi.php";
if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `saran` WHERE id = '$delete_id'");
  header('location:messages.php');
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    .messages .box-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, 33rem);
      gap: 1.5rem;
      justify-content: center;
      align-items: center;
    }

    .messages .box-container .box {
      background-color: #fff;
      border-radius: .5rem;
      box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
      border: 1rem solid #34495e;
      padding: 1rem;
    }

    .messages .box-container .box p {
      text-align: left;
      padding: .5rem 0;
      font-size: 20px;
      color: #34495e;
    }

    .messages .box-container .box p span {
      color: #f86909;
    }

    .messages h1 {
      margin-top: 50px;
      margin-bottom: 50px;
      color: white;
      text-shadow: 0 0 4px #e5ebb2;
    }

    .delete-btn {
      display: block;
      margin-top: 1rem;
      margin-left: 35%;
      background-color: #e74c3c;
      border-radius: 10px;
      cursor: pointer;
      width: 20%;
      font-size: 15px;
      color: white;
      padding: 10px;
      text-transform: capitalize;
      text-align:center;
      text-shadow: 0 0 4px #e5ebb2;
      text-decoration: none;
    }
    @media screen and (max-width: 550px){
      .messages .box-container .box p{
        font-size: 18px;
      }
    }
    @media screen and (max-width: 425px){
      .messages .box-container .box p{
        font-size: 16px;
      }
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
          <li> <a href="admin.php"> HOME </a></li>
          <li> <a href="../../produk/admin_list_barang.php"> PRODUCT </a></li>
          <li> <a href="kelola.php" > DASHBOARD </a></li>
          <li> <a href="" style="color: #fa022e;"> MESSAGES </a></li>
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
    <div class="messages">
      <h1 class="heading">Masukan & Saran</h1>

      <div class="box-container">

        <?php
        $result = mysqli_query($conn, "SELECT * from `saran`");
        if (mysqli_num_rows($result) > 0) {
          $data = [];
          while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
          }
          foreach ($data as $saran):
        ?>
        <div class="box">
          <p> Nama : <span>
              <?php echo $saran['nama']; ?>
            </span> </p>
          <p> Email : <span>
              <?php echo $saran['email']; ?>
            </span> </p>
          <p> Saran : <span>
              <?php echo $saran['saran']; ?>
            </span> </p>
          <a href="messages.php?delete=<?= $saran['id']; ?>" class="delete-btn"
            onclick="return confirm('delete this message?');">delete</a>
        </div>
        <?php
          endforeach;
        } else {
          echo '<p class="empty">you have no messages</p>';
        }
        ?>
      </div>

    </div>
    <script src="../../scriptabout.js"></script>
</body>

</html>
