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

            $id_alat=addslashes(trim($_POST["id_alat"]));
            $nama_alat=addslashes(trim(ucwords($_POST["nama_alat"])));
            $merek=addslashes(trim(ucwords($_POST["merek"])));
            $status=addslashes(trim($_POST["status"]));
    
            $sql="update alat set
            nama_alat='$nama_alat',
            merek='$merek',
            status='$status'
            where id_alat='$id_alat'";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=alat&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=alat&edit=gagal");
            }
        }
    }
?>

<?php
    //Mengambil data alat
    $id_alat=$_POST["id_alat"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM alat where id_alat=$id_alat");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/alat/edit.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <input type="hidden" name="id_alat" value="<?php echo $data['id_alat'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama_alat" value="<?php echo $data['nama_alat'];?>" class="form-control" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Merek:</label>
        <input type="text" name="merek" value="<?php echo $data['merek'];?>" class="form-control" placeholder="Masukan Merek">
    </div>

    <!-- radio -->
    <div class="form-group">
    <label>Status : </label>
        <div class="radio">
        <label>
        <input type="radio" <?php if ($data['status']=='1') echo "checked";?> name="status" value="1">
            Sewa
        </label>
        </div>
        <div class="radio">
        <label>
        <input type="radio" <?php if ($data['status']=='2') echo "checked";?> name="status" value="2">
            Milik Sendiri
        </label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
