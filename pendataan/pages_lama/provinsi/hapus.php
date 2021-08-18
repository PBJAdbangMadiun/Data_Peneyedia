<?php
 
    include '../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_prov=$_GET['id_prov'];

    //Menghapus data provinsi
    $hapus_provinsi=mysqli_query($kon,"delete from provinsi where id_prov='$id_prov'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_provinsi) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=provinsi&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=provinsi&hapus=gagal");

    }
        
    
?>