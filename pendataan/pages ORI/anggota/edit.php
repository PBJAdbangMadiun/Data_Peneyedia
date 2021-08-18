<?php
    if (isset($_POST['submit'])) {
        //Memulai session
        session_start();
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");
            $id_anggota=addslashes(trim($_POST["id_anggota"]));
            $nama=addslashes(trim(ucwords($_POST["nama"])));
            $pendidikan=addslashes(trim($_POST["pendidikan"]));
            $alamat=addslashes(trim($_POST["alamat"]));
    

            $sql="update anggota set
            nama='$nama',
            pendidikan='$pendidikan',
            alamat='$alamat'
            where id_anggota='$id_anggota'";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=anggota&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=anggota&edit=gagal");
            }
        }
    }
?>

<?php
    //Mengambil data anggota
    $id_anggota=$_POST["id_anggota"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM anggota where id_anggota=$id_anggota");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/anggota/edit.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <input type="hidden" name="id_anggota" value="<?php echo $data['id_anggota'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?php echo $data['nama'];?>" class="form-control" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Pendidikan:</label>
        <select class="form-control" id="pendidikan" name="pendidikan">
            <option <?php if ($data['pendidikan']=='SLTA') echo "selected"; ?> value="SLTA">SLTA/Sederajat</option>
            <option <?php if ($data['pendidikan']=='D3') echo "selected"; ?> value="D3">D3</option>
            <option <?php if ($data['pendidikan']=='S1') echo "selected"; ?> value="S1">S1</option>
            <option <?php if ($data['pendidikan']=='S2') echo "selected"; ?> value="S2">S2</option>
            <option <?php if ($data['pendidikan']=='lainnya') echo "selected"; ?> value="lainnya">Lainnya</option>
        </select>
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <textarea class="form-control" rows="3" name="alamat" id="alamat"><?php echo $data['alamat'];?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
