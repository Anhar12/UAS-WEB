<?php 
    session_start();
    if ($_SESSION["priv"] != "admin") {
        header("Location: ../login.php");
    }

    require '../koneksi.php';

    $id = $_GET['id'];

    $result = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");

    if ($result) {
        echo"
            <script>
                alert('Data berhasil dihapus');
                document.location.href = '../pengguna/admin/kelola-barang.php';
            </script>
        ";
    }else{  
        echo"
            <script>
                alert('Data gagal dihapus');
                document.location.href = '../pengguna/admin/kelola-barang.php';
            </script>
        ";
    }

?>