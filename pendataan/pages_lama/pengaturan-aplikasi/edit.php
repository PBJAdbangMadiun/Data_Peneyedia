<?php

if (isset($_POST['ubah_aplikasi'])) {

    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';
    
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        //Mengambil kiriman nilai
        $id=$_POST["id"];
        $nama_aplikasi=$_POST["nama"];

        $sql="update profil_aplikasi set
        nama_aplikasi='$nama_aplikasi'
        where id=$id";

        //Menjalankan query 
        $update_profil_aplikasi=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($update_profil_aplikasi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pengaturan&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pengaturan&edit=gagal");
        }

    }

}
?>