<?php 
    $host = "localhost";
    $username = "root";
    $password = "";

    // Sesuaikan dengan nama Database yang ada di phpmyadmin local
    // Jika download Database dari Github maka 
    // tinggal Import Database saja tidak perlu mengubah nama Database
    $database = "pa web";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Gagal terhubung ke database" . mysqli_connect_error());
    }
?>