<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Pengaturan Aplikasi
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> Pengaturan Aplikasi</li>
    </ol>
</section>

<?php 

    //Koneksi database
    include 'config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from profil_aplikasi order by nama_aplikasi desc limit 1");
    $data = mysqli_fetch_array($hasil); 
    
?>
<!-- Main content -->
<section class="content">

<?php
    //Validasi hanya admin yang boleh mengakses halaman ini
  if ($_SESSION["level"]!='Admin' and $_SESSION["level"]!='admin'){
    echo"<br><div class='alert alert-danger'>Tidak memiliki hak akses</div>";
    exit;
  }
?>

<?php 
    if (isset($_GET['edit'])) {
        //Menampilkan pesan saat admin mengubah profil aplikasi
        if ($_GET['edit']=='berhasil'){
            echo"<div class='alert alert-success'>Profil aplikasi telah berhasil diubah</div>";
        }else if ($_GET['edit']=='gagal'){
            echo"<div class='alert alert-danger'>Profil aplikasi gagal diubah</div>";
        }    
    }

?>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- Kategori -->
            <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
                <div class="box-body">
              
                <form action="pages/pengaturan-aplikasi/edit.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo $data['id'];?>" name="id">  
                        </div>
                        <div class="form-group">
                            <label>Nama Aplikasi:</label>
                            <input type="text" class="form-control" value="<?php echo $data['nama_aplikasi'];?>" name="nama" required>  
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"name="ubah_aplikasi" >Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</section>


<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>
<script>

    $(document).on("click", "#pilih_logo", function() {
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

</script>