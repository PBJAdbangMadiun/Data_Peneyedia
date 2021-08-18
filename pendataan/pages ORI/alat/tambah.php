<?php
    if (isset($_POST['submit'])) {
 
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nama_alat=addslashes(trim(ucwords($_POST["nama_alat"])));
            $merek=addslashes(trim(ucwords($_POST["merek"])));
            $status=addslashes(trim($_POST["status"]));

            $sql="insert into alat (nama_alat,merek,status) values
            ('$nama_alat','$merek','$status')";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=alat&tambah=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=alat&tambah=gagal");
            }
        }
    }
?>


<form action="pages/alat/tambah.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama_alat" class="form-control" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Merek:</label>
        <input type="text" name="merek" class="form-control" placeholder="Masukan Merek">
    </div>

    <!-- radio -->
    <div class="form-group">
    <label>Status : </label>
        <div class="radio">
        <label>
        <input type="radio" name="status" value="1">
            Sewa
        </label>
        </div>
        <div class="radio">
        <label>
        <input type="radio" name="status" value="2">
            Milik Sendiri
        </label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
