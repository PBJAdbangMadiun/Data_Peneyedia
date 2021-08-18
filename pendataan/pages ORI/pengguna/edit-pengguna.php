<?php
session_start();
    if (isset($_POST['edit_pengguna'])) {
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");
        
        //Mengambil nilai kiriman form
        $id_pengguna=addslashes(trim($_POST["id_pengguna"]));
        $kode_pengguna=addslashes(trim($_POST["kode_pengguna"]));
        $nama_pengguna=addslashes(trim(ucwords($_POST["nama_pengguna"])));
        $email=addslashes(trim($_POST["email"]));
        $username=addslashes(trim($_POST["username"]));
        $status=addslashes(trim($_POST["status"]));
        $level=addslashes(trim($_POST["level"]));
        $foto_saat_ini=$_POST['foto_saat_ini'];
        $foto_baru = $_FILES['foto_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $x = explode('.', $foto_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['foto_baru']['size'];
        $file_tmp = $_FILES['foto_baru']['tmp_name'];

        //Mengambil password
        $ambil_password=mysqli_query($kon,"select password from pengguna where id_pengguna=$id_pengguna limit 1");
        $data = mysqli_fetch_array($ambil_password);

        //Membandingkan password
        if ($data['password']==$_POST["password"]){
            $password=addslashes(trim($_POST["password"]));
        }else {
            $password=md5(addslashes(trim($_POST["password"])));
        }

        //Cek apakah user mengunggah foto baru
        if (!empty($foto_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                //Mengupload foto baru
                move_uploaded_file($file_tmp, 'foto/'.$foto_baru);

                //Menghapus foto lama, foto yang dihapus selain foto default
                if ($foto_saat_ini!='pengguna_default.png'){
                    unlink("foto/".$foto_saat_ini);
                }
                
                $sql="update pengguna set
                nama_pengguna='$nama_pengguna',
                email='$email',
                username='$username',
                password='$password',
                level='$level',
                status='$status',
                foto='$foto_baru'
                where id_pengguna=$id_pengguna";
            }
        }else {
            $sql="update pengguna set
            nama_pengguna='$nama_pengguna',
            email='$email',
            username='$username',
            password='$password',
            level='$level',
            status='$status'
            where id_pengguna=$id_pengguna";
        }

        //Mengeksekusi atau menjalankan query 
        $edit_pengguna=mysqli_query($kon,$sql);
        
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($edit_pengguna) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pengguna&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pengguna&edit=gagal");

        }
        
    }
?>

<?php
    //Mengambil data pengguna
    $id_pengguna=$_POST["id_pengguna"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM pengguna where id_pengguna=$id_pengguna");
    $data = mysqli_fetch_array($query); 

    $kode_pengguna=$data['kode_pengguna'];
    $nama_pengguna=$data['nama_pengguna'];
    $email=$data['email'];
    $username=$data['username'];
    $password=$data['password'];
    $level=$data['level'];
    $status=$data['status'];
?>
<form action="pages/pengguna/edit-pengguna.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode pengguna:</label>
        <h3><?php echo $kode_pengguna; ?></h3>
        <input name="kode_pengguna" value="<?php echo $kode_pengguna; ?>" type="hidden" class="form-control">
        <input name="id_pengguna" value="<?php echo $id_pengguna; ?>" type="hidden" class="form-control">
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama pengguna:</label>
                <input name="nama_pengguna" value="<?php echo $nama_pengguna; ?>" type="text" class="form-control" placeholder="Masukan nama" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                    <label>Email:</label>
                    <input name="email" value="<?php echo $email; ?>" type="email" class="form-control" placeholder="Masukan email" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Username:</label>
                <input name="username" value="<?php echo $username; ?>" type="text" id="username" class="form-control" placeholder="Masukan username" required>
                <div id="info_username"> </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Password:</label>
                <input name="password" value="<?php echo $password; ?>" type="password" class="form-control" placeholder="Masukan password" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Level Pengguna:</label>
                <select name="level" class="form-control">
                <?php
                    $daftar_level = array("Pengguna", "Admin");
                    for ($i=0;$i<=1;$i++):
                ?>
                <option <?php if ($daftar_level[$i]==$level) echo "selected"; ?> value="<?php echo $daftar_level[$i];?>"><?php echo $daftar_level[$i];?></option>
                <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Status:</label>
                <select name="status" class="form-control">
                    <option <?php if ($status==1) echo "selected"; ?> value="1">Aktif</option>
                    <option <?php if ($status==0) echo "selected"; ?> value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
    </div>

    <!-- rows -->                 
    <div class="row">
        <div class="col-sm-6">
            <div id="msg"></div>
            <label>Foto:</label>
            <input type="file" name="foto_baru" class="file" >
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                    <div class="input-group-append">
                            <button type="button" id="pilih_foto" class="browse btn btn-primary">Pilih Foto</button>
                    </div>
                </div>
            <img src="pages/pengguna/foto/<?php echo $data['foto'];?>" id="preview" class="img-thumbnail">
            <input type="hidden" name="foto_saat_ini" value="<?php echo $data['foto'];?>" class="form-control" />
        </div>
    </div>
    <br>
    <button type="submit" name="edit_pengguna" id="edit_pengguna" class="btn btn-success">Update Pengguna</button>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

<script>
    $(document).on("click", "#pilih_foto", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });

    $("#username").bind('keyup', function () {

        var username = $('#username').val();
        $.ajax({
            url: 'pages/pengguna/cek-username.php',
            method: 'POST',
            data:{username:username},
            success:function(data){
                $('#info_username').show();
                $('#info_username').html(data);
            }
        }); 

    });
</script>
