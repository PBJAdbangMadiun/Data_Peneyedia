<?php
    if (isset($_POST['submit'])) {
 
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
     

            $nama=addslashes(trim(ucwords($_POST["nama"])));

            $sql="insert into provinsi (nama) values
            ('$nama')";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
   
                header("Location:../../index.php?page=provinsi&tambah=berhasil");
            }
            else {
    
                header("Location:../../index.php?page=provinsi&tambah=gagal");
            }
        }
    }
?>


<form action="pages/provinsi/tambah.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama OPD:</label>
        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama OPD">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
