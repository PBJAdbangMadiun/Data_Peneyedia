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

            $id_prov=addslashes(trim($_POST["id_prov"]));
            $nama=addslashes(trim(ucwords($_POST["nama"])));
    
            $sql="update provinsi set
            nama='$nama'
            where id_prov='$id_prov'";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=provinsi&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=provinsi&edit=gagal");
            }
        }
    }
?>

<?php
    //Mengambil data provinsi
    $id_prov=$_POST["id_prov"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM provinsi where id_prov=$id_prov");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/provinsi/edit.php" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <input type="hidden" name="id_prov" value="<?php echo $data['id_prov'];?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?php echo $data['nama'];?>" class="form-control" placeholder="Masukan Nama Provinsi">
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
