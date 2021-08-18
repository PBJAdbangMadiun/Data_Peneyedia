<?php
 
    include '../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_pengguna=$_GET['id_pengguna'];

    //Menghapus data pengguna dan detail pengguna
    $hapus_pengguna=mysqli_query($kon,"delete from pengguna where id_pengguna='$id_pengguna'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_pengguna) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=pengguna&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=pengguna&hapus=gagal");

    }
        
    
?>