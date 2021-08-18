<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Pengguna
    <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pengguna</li>
    </ol>
</section>

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
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah pengguna
    if (isset($_GET['add'])) {
        if ($_GET['add']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Pengguna telah ditambahkan!</div>";
        }else if ($_GET['add']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Pengguna gagal ditambahkan!</div>";
        }    
    }
  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah pengguna
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Pengguna telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Pengguna gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus pengguna
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Pengguna telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Pengguna gagal dihapus!</div>";
      }    
    }
?>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- Pengguna -->
            <div class="box box-success">
            <div class="box-header with-border">
                <button type="button" class="btn btn-primary" id="tambah">Tambah</button>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
        
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Koneksi database
                        include 'config/database.php';
                        //perintah sql untuk menampilkan daftar pengguna
                        $sql="select * from pengguna order by id_pengguna desc";
                        $hasil=mysqli_query($kon,$sql);
                        $no=0;
                        //Menampilkan data dengan perulangan while
                        while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['kode_pengguna']; ?></td>
                        <td><?php echo $data['nama_pengguna']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['level']; ?></td>
                        <td><?php echo $data['status'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                        <td>
                            <button class="tombol_edit btn btn-warning btn-circle" id_pengguna="<?php echo $data['id_pengguna']; ?>" kode_pengguna="<?php echo $data['kode_pengguna']; ?>" data-toggle="tooltip" title="Edit pengguna" data-placement="top"><i class="fa fa-edit"></i></button>
                            <a href="pages/pengguna/hapus-pengguna.php?id_pengguna=<?php echo $data['id_pengguna']; ?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <!-- bagian akhir (penutup) while -->
                    <?php endwhile; ?>
                </tbody>
                </table>
            </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- jQuery 3 -->




<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div id="tampil_data">
                 <!-- Data akan di load menggunakan AJAX -->                   
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>


<script>
    // Tambah pengguna
    $('#tambah').on('click',function(){
        $.ajax({
            url: 'pages/pengguna/tambah-pengguna.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Pengguna';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit pemasukan
    $('.tombol_edit').on('click',function(){
        var id_pengguna = $(this).attr("id_pengguna");
        $.ajax({
            url: 'pages/pengguna/edit-pengguna.php',
            method: 'post',
            data: {id_pengguna:id_pengguna},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Pengguna';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // fungsi hapus pengeluaran
   $('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus jenis pengeluaran ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


