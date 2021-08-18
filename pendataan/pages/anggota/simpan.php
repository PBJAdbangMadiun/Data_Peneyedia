<?php

    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';
    
    //Memulai transaksi
    mysqli_query($kon,"START TRANSACTION");

    $id_pekerjaan=addslashes(trim($_POST["id_pekerjaan"]));
    $nama=addslashes(trim(ucwords($_POST["nama"])));
    $pendidikan=addslashes(trim($_POST["pendidikan"]));
    $alamat=addslashes(trim($_POST["alamat"]));

    $sql="insert into anggota (nama,pendidikan,alamat) values
    ('$nama','$pendidikan','$alamat')";

    $simpan_data_master=mysqli_query($kon,$sql);

    $query = mysqli_query($kon, "SELECT id_anggota FROM anggota order by id_anggota desc limit 1");
    $data = mysqli_fetch_array($query); 

    $anggota = $data['id_anggota'];

    $sql1="insert into anggota_pekerjaan (id_anggota,id_pekerjaan) values
    ('$anggota','$id_pekerjaan')";
    
    $simpan_detail=mysqli_query($kon,$sql1);


    if ($simpan_detail and  $simpan_data_master) {
        mysqli_query($kon,"COMMIT");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
    }
    

?>
