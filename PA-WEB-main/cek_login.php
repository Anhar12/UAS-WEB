<?php
  session_start();
  if ($_SESSION["priv"] != "user") {
    header("Location: login.php");
    return;
  }
  $_SESSION["produk"] = $_GET["id"];
  header("Location: pesanan/tambah_pesanan_user.php");
?>