<?php

    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';
    
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_pekerjaan=addslashes(trim($_POST["id_pekerjaan"]));
    $nama_alat=addslashes(trim(ucwords($_POST["nama_alat"])));
    $merek=addslashes(trim($_POST["merek"]));
    $status=addslashes(trim($_POST["status"]));

    $sql="insert into alat (nama_alat,merek,status) values
    ('$nama_alat','$merek','$status')";

    $simpan_data_master=mysqli_query($kon,$sql);

    $query = mysqli_query($kon, "SELECT id_alat FROM alat order by id_alat desc limit 1");
    $data = mysqli_fetch_array($query); 

    $alat = $data['id_alat'];

    $sql1="insert into alat_pekerjaan (id_alat,id_pekerjaan) values
    ('$alat','$id_pekerjaan')";
    
    $simpan_detail=mysqli_query($kon,$sql1);

    if ($simpan_detail and  $simpan_data_master) {
        mysqli_query($kon,"COMMIT");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
    }
    

?>
