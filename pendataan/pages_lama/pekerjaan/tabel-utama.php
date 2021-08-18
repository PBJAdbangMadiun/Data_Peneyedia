<div class="table-responsive no-padding">
<table id="example1" class="table table-hover table-striped table-bordered">
    <tr>

        <th class="text-center">Bagian</th>
        <th class="text-center">Tahun</th>
        <th class="text-center">Kelompok</th>
        <th class="text-center">Pengurus</th>
        <th class="text-center">Iuran</th>
        <th class="text-center">Anggota</th>
        <th class="text-center">Alat</th>
        <th width="8%">Aksi</th>
    </tr>

        <?php

            include '../../config/database.php';

            $page = (isset($_POST['page']))? $_POST['page'] : 1;
            $limit = 5; 
            $limit_start = ($page - 1) * $limit;
            $no = $limit_start + 1;


            if ($_POST['status']!='' and $_POST['kata_kunci']!=''){
                $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.status='".$_POST['status']."' and (p.nama_bagian like '%".$_POST['kata_kunci']."%' or n.nama like '%".$_POST['kata_kunci']."%' or k.nama_kelompok like '%".$_POST['kata_kunci']."%' or t.nama like '%".$_POST['kata_kunci']."%') order by p.id_pekerjaan desc limit $limit_start,$limit";
            }else if ($_POST['status']!='' and $_POST['kata_kunci']==''){
                $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.status='".$_POST['status']."' order by p.id_pekerjaan desc limit $limit_start,$limit";
            } else if ($_POST['status']=='' and $_POST['kata_kunci']!=''){
                $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.nama_bagian like '%".$_POST['kata_kunci']."%' or n.nama like '%".$_POST['kata_kunci']."%' or k.nama_kelompok like '%".$_POST['kata_kunci']."%' or t.nama like '%".$_POST['kata_kunci']."%' order by p.id_pekerjaan desc limit $limit_start,$limit";
            } else {
                $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota order by p.id_pekerjaan desc limit $limit_start,$limit";
            }
        
           
         
            $hasil=mysqli_query($kon,$query);
            $no=0;


            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;
            $sql="select * from kelompok k inner join pekerjaan p on p.kelompok=k.id_kelompok where p.id_pekerjaan='".$data['id_pekerjaan']."'";
            $result=mysqli_query($kon,$sql);
            $row = mysqli_fetch_array($result);



        ?>
        <tr>

            <td>
            <?php echo ucwords($data['nama_bagian']); ?> <br>
            <?php echo $data['nama_provinsi']; ?><br>
            <?php 
                if ($data['status']==1){
                    echo "<span class='label label-success'>Berjalan</span>";
                }else if ($data['status']==2){
                    echo "<span class='label label-warning'>Cadangan</span>";
                }else if ($data['status']==3){
                    echo "<span class='label label-danger'>Dibatalkan</span>";
                }
            ?>
            </td>

            <td>
            Tahun Anggaran : <?php echo $data['tahun_anggaran'];?><br>
            Tanggal Kontrak : <?php echo date('d-m-Y', strtotime($data["tanggal_kontrak"])); ?>
            </td>
    
            <td> 
                <?php echo ucwords($row['nama_kelompok']); ?> <br>
                <?php echo $row['alamat']; ?><br>
                <?php echo $row['no_telp']; ?>
            </td>

            <td> 
                Ketua : <?php echo $row['ketua']; ?> <br>
                Wakil : <?php echo $row['wakil']; ?>
            </td>

            <td>
            Iuran I Rp. <?php echo number_format($data['iuran1'],0,',','.');  ?><br>
            Iuran II Rp. <?php echo number_format($data['iuran2'],0,',','.');  ?><br>
            Iuran III Rp. <?php echo number_format($data['iuran3'],0,',','.');  ?>
            </td>

            <td>
            <?php 
                $sql="select * from anggota a inner join anggota_pekerjaan p on p.id_anggota=a.id_anggota where p.id_pekerjaan='".$data['id_pekerjaan']."'";
                $get_anggota=mysqli_query($kon,$sql);
                $a=1;
                while ($anggota = mysqli_fetch_array($get_anggota)){
                    echo "<strong>Anggota ".$a."</strong> <br>";
                        echo "Nama : ".$anggota['nama']." <br>";
                        echo "Pendidikan :".$anggota['pendidikan']."<br>";
                        echo "Alamat : ".$anggota['alamat']."<br>";
                        $a++;
                }
            
            ?>
            </td>
            <td>
            <?php 
                $sql="select * from alat a inner join alat_pekerjaan p on p.id_alat=a.id_alat where p.id_pekerjaan='".$data['id_pekerjaan']."'";
                $get_alat=mysqli_query($kon,$sql);
                $x=1;
                while ($alat = mysqli_fetch_array($get_alat)){
                    echo "<strong>Alat ".$x."</strong> <br>";
                    echo "Nama : ".$alat['nama_alat']." <br>";
                    echo "Merek :".$alat['merek']."<br>";
                    echo "Status : ".$alat['status']."<br>";
                    $x++;
                }
            
            ?>
            </td>
            <td>
            <div class="col-sm-6">
                <button class="tombol_alat btn btn-success btn-circle" id_pekerjaan="<?php echo $data['id_pekerjaan']; ?>"  ><i class="fa fa-cog"></i></button>
                <button class="tombol_anggota btn btn-primary btn-circle" id_pekerjaan="<?php echo $data['id_pekerjaan']; ?>"  ><i class="fa fa-user"></i></button>
                <br>
            </div>
            <div class="col-sm-6">
                <button class="tombol_edit btn btn-warning btn-circle" id_pekerjaan="<?php echo $data['id_pekerjaan']; ?>"  ><i class="fa fa-edit"></i></button>
                <a href="pages/pekerjaan/hapus.php?id_pekerjaan=<?php echo $data['id_pekerjaan']; ?>" class="tombol_hapus btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
            </div>
            
        
            </td>      
        </tr>
        <?php endwhile; ?>
    </table>
</div> 
<br>

<nav class="mb-5">
    <ul class="pagination justify-content-end">
    <?php

    
        if ($_POST['status']!='' and $_POST['kata_kunci']!=''){
            $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.status='".$_POST['status']."' and (p.nama_bagian like '%".$_POST['kata_kunci']."%' or n.nama like '%".$_POST['kata_kunci']."%' or k.nama_kelompok like '%".$_POST['kata_kunci']."%' or t.nama like '%".$_POST['kata_kunci']."%') order by p.id_pekerjaan desc";
        }else if ($_POST['status']!='' and $_POST['kata_kunci']==''){
            $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.status='".$_POST['status']."' order by p.id_pekerjaan desc";
        } else if ($_POST['status']=='' and $_POST['kata_kunci']!=''){
            $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.nama_bagian like '%".$_POST['kata_kunci']."%' or n.nama like '%".$_POST['kata_kunci']."%' or k.nama_kelompok like '%".$_POST['kata_kunci']."%' or t.nama like '%".$_POST['kata_kunci']."%' order by p.id_pekerjaan desc";
        } else {
            $query="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.kode_opd=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota order by p.id_pekerjaan desc";
        }


        $query2     = mysqli_query($kon,$query);
        $jmldata    = mysqli_num_rows($query2);
        $jumlah_page = ceil($jmldata / $limit);
    
        for($i = 1; $i <= $jumlah_page; $i++){
        $link_active = ($page == $i)? ' active' : '';
        echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }

    ?>
    </ul>
</nav>
<br>
<a href="pages/pekerjaan/export-excel.php?kata_kunci=<?php echo $_POST['kata_kunci']; ?>&status=<?php echo $_POST['status']; ?>" target='blank' class="btn btn-success"><span class="text"><i class="fa fa-file-excel-o fa-sm"></i> Export Excel</span></a>


<script>
    // Edit pekerjaan
    $('.tombol_edit').on('click',function(){
        var id_pekerjaan = $(this).attr("id_pekerjaan");
        $.ajax({
            url: 'pages/pekerjaan/edit.php',
            method: 'post',
            data: {id_pekerjaan:id_pekerjaan},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit pekerjaan';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Edit pekerjaan
    $('.tombol_alat').on('click',function(){
        var id_pekerjaan = $(this).attr("id_pekerjaan");
        $.ajax({
            url: 'pages/pekerjaan/tambah-alat.php',
            method: 'post',
            data: {id_pekerjaan:id_pekerjaan},
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
    // Edit pekerjaan
    $('.tombol_anggota').on('click',function(){
        var id_pekerjaan = $(this).attr("id_pekerjaan");
        $.ajax({
            url: 'pages/pekerjaan/tambah-anggota.php',
            method: 'post',
            data: {id_pekerjaan:id_pekerjaan},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Anggota';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>



<script>
// fungsi hapus 
$('.tombol_hapus').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus pekerjaan ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>




