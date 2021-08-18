<?php
    include "koneksi.php";

    $sql = "CREATE TABLE user(
        id int PRIMARY KEY,
        Nama varchar(50),
        role varchar(50),
    )";
    
    if ($koneksi->query($sql) == TRUE){
        echo "terdaftar";
    } else {
        echo "zonk";
    }

?>