<?php
    if (isset($_POST['submit'])) {
 
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nama_kelompok=addslashes(trim(ucwords($_POST["nama_kelompok"])));
            $alamat=addslashes(trim($_POST["alamat"]));
            $no_telp=addslashes(trim($_POST["no_telp"]));
            $ketua=addslashes(trim(ucwords($_POST["ketua"])));
            $wakil=addslashes(trim(ucwords($_POST["wakil"])));

            $sql="insert into kelompok (nama_kelompok,alamat,no_telp,ketua,wakil) values
            ('$nama_kelompok','$alamat','$no_telp','$ketua','$wakil')";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=kelompok&tambah=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=kelompok&tambah=gagal");
            }
        }
    }
?>


<form action="pages/kelompok/tambah.php" method="post" >

    <div class="form-group">
        <label>Nama Penyedia:</label>
        <input type="text" name="nama_kelompok" class="form-control" placeholder="Masukan Nama Penyedia">
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <textarea class="form-control" rows="3" name="alamat" id="alamat"></textarea>
    </div>

    <div class="form-group">
        <label>NPWP:</label>
        <input type="text" name="no_telp" class="form-control" placeholder="Masukan NPWP">
    </div>

    <div class="form-group">
        <label>Direktur:</label>
        <input type="text" name="ketua" class="form-control" placeholder="Masukan Direktur">
    </div>


    <div class="form-group">
        <label>Komanditer:</label>
        <input type="text" name="wakil" class="form-control" placeholder="Masukan Komanditer">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
