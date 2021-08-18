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
            
            $id_kelompok=addslashes(trim($_POST["id_kelompok"]));
            $nama_kelompok=addslashes(trim(ucwords($_POST["nama_kelompok"])));
            $alamat=addslashes(trim($_POST["alamat"]));
            $no_telp=addslashes(trim($_POST["no_telp"]));
            $ketua=addslashes(trim(ucwords($_POST["ketua"])));
            $wakil=addslashes(trim(ucwords($_POST["wakil"])));
    
            $sql="update kelompok set
            nama_kelompok='$nama_kelompok',
            alamat='$alamat',
            no_telp='$no_telp',
            ketua='$ketua',
            wakil='$wakil'
            where id_kelompok='$id_kelompok'";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=kelompok&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=kelompok&edit=gagal");
            }
        }
    }
?>

<?php
    //Mengambil data kelompok
    $id_kelompok=$_POST["id_kelompok"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM kelompok where id_kelompok=$id_kelompok");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/kelompok/edit.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <input type="hidden" name="id_kelompok" value="<?php echo $data['id_kelompok'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Nama Kelompok:</label>
        <input type="text" name="nama_kelompok" value="<?php echo $data['nama_kelompok'];?>" class="form-control" placeholder="Masukan Nama Kelompok">
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <textarea class="form-control" rows="3" name="alamat" id="alamat"><?php echo $data['alamat'];?></textarea>
    </div>

    <div class="form-group">
        <label>No Telp:</label>
        <input type="number" name="no_telp" value="<?php echo $data['no_telp'];?>" class="form-control" placeholder="Masukan No Telp">
    </div>

    <div class="form-group">
        <label>Ketua:</label>
        <input type="text" name="ketua" value="<?php echo $data['ketua'];?>" class="form-control" placeholder="Masukan Ketua">
    </div>


    <div class="form-group">
        <label>Wakil:</label>
        <input type="text" name="wakil" value="<?php echo $data['wakil'];?>" class="form-control" placeholder="Masukan Wakil Ketua">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
