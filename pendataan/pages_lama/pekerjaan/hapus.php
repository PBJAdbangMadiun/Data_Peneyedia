<?php
 
    include '../../config/database.php';
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_pekerjaan=$_GET['id_pekerjaan'];

    //Menghapus data pekerjaan
    $hapus_pekerjaan=mysqli_query($kon,"delete from pekerjaan where id_pekerjaan='$id_pekerjaan'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_pekerjaan) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=pekerjaan&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=pekerjaan&hapus=gagal");

    }
        
    
?>