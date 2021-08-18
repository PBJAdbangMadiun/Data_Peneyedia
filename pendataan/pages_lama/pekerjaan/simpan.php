<?php

    if (isset($_POST['anggota'])){
        
        include '../../config/database.php';

        $anggota = $_POST['anggota'];
        $id_pekerjaan = $_POST['id_pekerjaan'];

        $sql="insert into anggota_pekerjaan (id_anggota,id_pekerjaan) values
        ('$anggota','$id_pekerjaan')";

        mysqli_query($kon,$sql);


    } else if ($_POST['aksi']=='hapus-anggota') {

        include '../../config/database.php';

        $id_anggota = $_POST['id_anggota'];
        $id_pekerjaan = $_POST['id_pekerjaan'];
    
        mysqli_query($kon,"delete from anggota_pekerjaan where id_anggota='$id_anggota' and id_pekerjaan='$id_pekerjaan'");
    
    } else if ($_POST['aksi']=='tambah-alat') {

        include '../../config/database.php';

        $alat = $_POST['alat'];
        $id_pekerjaan = $_POST['id_pekerjaan'];

        $sql="insert into alat_pekerjaan (id_alat,id_pekerjaan) values
        ('$alat','$id_pekerjaan')";

        mysqli_query($kon,$sql);
    
    } else if ($_POST['aksi']=='hapus-alat') {

        include '../../config/database.php';

        $id_alat = $_POST['id_alat'];
        $id_pekerjaan = $_POST['id_pekerjaan'];
    
        mysqli_query($kon,"delete from alat_pekerjaan where id_alat='$id_alat' and id_pekerjaan='$id_pekerjaan'");
    
    }



?>