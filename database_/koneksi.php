<?php 
    $host = "localhost"; //host database
    $username = "root"; //username database 
    $password = ""; //password database
   
    $koneksi = new mysqli ($host, $username, $password); //membuat koneksi ke server mysql

    if ($koneksi->connect_error){
        die ("gagal");
    } else {
        echo "berhasil";
    }

?>