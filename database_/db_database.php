<?php
    include "koneksi.php";

    $sql = "CREATE DATABASE database_1";

    if ($koneksi->query($sql) === TRUE){
        echo "berhasil lagi";
    } else {
        echo "gagal";
    }
?>
