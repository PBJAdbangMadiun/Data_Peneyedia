<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Alat
    <small>Menampilkan Daftar alat</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">alat</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<?php
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah alat
    if (isset($_GET['tambah'])) {
        if ($_GET['tambah']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Alat telah ditambahkan!</div>";
        }else if ($_GET['tambah']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Alat gagal ditambahkan!</div>";
        }    
    }


  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah alat
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Alat telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Alat gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus alat
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> Alat telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> Alat gagal dihapus!</div>";
      }    
    }
?>


    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
        <button type="button" class="btn btn-primary" id="tambah_alat">Tambah</button>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive no-padding">
                <table id="example1" class="table table-hover table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Merek</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                        </tr>
                        <?php

                            include 'config/database.php';
                            $batas   = 10;
                            $bagian = @$_GET['bagian'];
                                if(empty($bagian)){
                                    $posisi  = 0;
                                    $bagian = 1;
                                }
                                else{
                                    $posisi  = ($bagian-1) * $batas;
                                }
                    
                            $no = $posisi+1;

                            $sql="select * from alat order by id_alat desc limit $posisi,$batas";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;

                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama_alat']; ?></td>
                            <td><?php echo $data['merek']; ?></td>
                            <td><?php echo $data['status'] == 1 ? 'Sewa' : 'Milik Sendiri';?></td>

                            <td>
                            <button class="tombol_edit btn btn-warning btn-circle" id_alat="<?php echo $data['id_alat']; ?>"  ><i class="fa fa-edit"></i></button>
                            <a href="pages/alat/hapus.php?id_alat=<?php echo $data['id_alat']; ?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                            </td>      
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
                <?php

                $query2     = mysqli_query($kon, "select * from alat");
                $jmldata    = mysqli_num_rows($query2);
                $jmlbagian = ceil($jmldata/$batas);
                ?>
                <div class="text-center">
                    <ul class="pagination">
                        <?php
                        for($i=1;$i<=$jmlbagian;$i++) {
                            if ($i != $bagian) {
                                echo "<li class='page-item'><a class='page-link' href='index.php?page=alat&bagian=$i'>$i</a></li>";
                            } else {
                                echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>              
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    </div>
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
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
    // Tambah alat
    $('#tambah_alat').on('click',function(){
        $.ajax({
            url: 'pages/alat/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Alat';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit alat
    $('.tombol_edit').on('click',function(){
        var id_alat = $(this).attr("id_alat");
        $.ajax({
            url: 'pages/alat/edit.php',
            method: 'post',
            data: {id_alat:id_alat},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Alat';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>



<script>
// fungsi hapus 
$('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus alat ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>






