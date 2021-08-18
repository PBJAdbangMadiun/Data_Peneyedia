<?php
    if (isset($_POST['submit'])) {
 
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nama=addslashes(trim(ucwords($_POST["nama"])));
            $pendidikan=addslashes(trim($_POST["pendidikan"]));
            $alamat=addslashes(trim($_POST["alamat"]));

            $sql="insert into anggota (nama,pendidikan,alamat) values
            ('$nama','$pendidikan','$alamat')";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("pages/pekerjaan/tambah-anggota.php?page=anggota&tambah=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=anggota&tambah=gagal");
            }
        }
    }
?>


<form action="pages/pekerjaan/simpan.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Pendidikan:</label>
        <select class="form-control" id="pendidikan" name="pendidikan">
            <option value="SLTA">SLTA/Sederajat</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <textarea class="form-control" rows="3" name="alamat" id="alamat"></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>