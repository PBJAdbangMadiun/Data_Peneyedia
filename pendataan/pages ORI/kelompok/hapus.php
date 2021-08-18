<?php
 
    include '../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_kelompok=$_GET['id_kelompok'];

    //Menghapus data kelompok
    $hapus_kelompok=mysqli_query($kon,"delete from kelompok where id_kelompok='$id_kelompok'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_kelompok) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=kelompok&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=kelompok&hapus=gagal");

    }
        
    
?>