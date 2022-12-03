<?php 
    $host = "sql305.epizy.com";
    $username = "epiz_33027576";
    $password = "JuhAaTwWHWJ0";
    $database = "epiz_33027576_pweb";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Gagal terhubung ke database" . mysqli_connect_error());
    }
?>
