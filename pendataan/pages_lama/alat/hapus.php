<?php
 
    include '../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_alat=$_GET['id_alat'];

    //Menghapus data alat
    $hapus_alat=mysqli_query($kon,"delete from alat where id_alat='$id_alat'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_alat) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=alat&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=alat&hapus=gagal");

    }
        
    
?>