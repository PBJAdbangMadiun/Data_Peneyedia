<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Pekerjaan
    <small>Menampilkan Daftar pekerjaan</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">pekerjaan</li>
    </ol>
</section>

<style type="text/css">
    p {
        font-size: 12px;
    }
</style>

<!-- Main content -->
<section class="content">

<small>
<?php
    //Validasi untuk menampilkan pesan pemberitahuan saat user menambah pekerjaan
    if (isset($_GET['tambah'])) {
        if ($_GET['tambah']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> pekerjaan telah ditambahkan!</div>";
        }else if ($_GET['tambah']=='gagal'){
            echo"<div class='alert alert-danger'><strong>Gagal!</strong> pekerjaan gagal ditambahkan!</div>";
        }    
    }


  
   //Validasi untuk menampilkan pesan pemberitahuan saat user mengubah pekerjaan
    if (isset($_GET['edit'])) {
      if ($_GET['edit']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> pekerjaan telah diupdate!</div>";
      }else if ($_GET['edit']=='gagal'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> pekerjaan gagal diupdate!</div>";
      }    
    }
     //Validasi untuk menampilkan pesan pemberitahuan saat user hapus pekerjaan
    if (isset($_GET['hapus'])) {
      if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-success'><strong>Berhasil!</strong> pekerjaan telah dihapus!</div>";
      }else if ($_GET['hapus']=='berhasil'){
          echo"<div class='alert alert-danger'><strong>Gagal!</strong> pekerjaan gagal dihapus!</div>";
      }    
    }
?>


    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
            <button type="button" class="btn btn-primary" id="tambah_pekerjaan">Tambah</button>
            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <select class="form-control" id="status" name="status">
                    <option value="">Pilih Jenis Pekerjaan</option>
                    <?php
                        include '../../config/database.php';
                        $hasil = mysqli_query($kon,"select * from status");
                        $jumlah = mysqli_num_rows($hasil);
                        while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?php echo  $data['id_status']; ?>"><?php echo ucwords($data['nama_status']); ?></option>
                            <?php
                        }
                    
                        ?>
                </select>
            </div>
            <div class="input-group input-group-sm ml-10" style="width: 150px;">
                <input type="text" name="table_search" id="kata_kunci" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                <button type="button" id="tombol_cari" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <hr>
            <div id="tabel_utama"> </div>
   
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

<div id='ajax-wait'>
<img alt='loading...' src='dist/img/Rolling-1s-84px.png' />
</div>

  <style>
    #ajax-wait {
        display: none;
        position: fixed;
        z-index: 2300
    }
  </style>

<script>

    $(document).ready(function(){
        tabel_utama();
    });


    
    //Fungsi untuk efek loading
    function loading(){
        $( document ).ajaxStart(function() {
        $( "#ajax-wait" ).css({
            left: ( $( window ).width() - 32 ) / 2 + "px", // 32 = lebar gambar
            top: ( $( window ).height() - 32 ) / 2 + "px", // 32 = tinggi gambar
            display: "block"
        })
        })
        .ajaxComplete( function() {
            $( "#ajax-wait" ).fadeOut();
        });
    }

    $(document).on('click', '.halaman', function(){
          var page = $(this).attr("id");
          tabel_utama(page);
    });




    function tabel_utama(page){
        loading();
        var kata_kunci=$("#kata_kunci").val();
        var status=$("#status").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/pekerjaan/tabel-utama.php',
            data:{kata_kunci:kata_kunci,status:status,page:page},
            success: function(data) {
                $("#tabel_utama").html(data);
            }
        });
    }

</script>


<script>
    // Tambah pekerjaan
    $('#tambah_pekerjaan').on('click',function(){
        $.ajax({
            url: 'pages/pekerjaan/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah pekerjaan';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // event saat tombol cari diklik
    $('#tombol_cari').on('click',function(){
        tabel_utama();
    });

    $("#status").change(function() {
        tabel_utama();
    });

    $('#kata_kunci').on('keyup input propertychange paste change', function(){
        tabel_utama();
    });

</script>

</small>




