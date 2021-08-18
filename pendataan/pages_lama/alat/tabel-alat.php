<table id="example1" class="table table-striped table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Merek</th>
        <th>Status</th>
        <th width="10%">Aksi</th>
    </tr>
    <?php

        $id_pekerjaan = $_POST['id_pekerjaan'];
   
        include '../../config/database.php';
        $sql="select * from alat a inner join alat_pekerjaan p on a.id_alat=p.id_alat where p.id_pekerjaan='".$id_pekerjaan."'";
        $hasil=mysqli_query($kon,$sql);
        $no=0;

        $jumlah = mysqli_num_rows($hasil);

        if ($jumlah<=0){
           echo "<div class='alert alert-info'> Alat belum ditambahkan</div>";
        }

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
        <button class="tombol_hapus_alat btn btn-danger btn-circle" id_alat="<?php echo $data['id_alat']; ?>" id_pekerjaan="<?php echo $id_pekerjaan; ?>"  ><i class="fa fa-trash"></i></button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


<script>

$('.tombol_hapus_alat').on('click',function(){
        var id_alat = $(this).attr("id_alat");
        var id_pekerjaan = $(this).attr("id_pekerjaan");
        var aksi='hapus-alat';
        konfirmasi=confirm("Yakin ingin menghapus alat ini ?")
        if (konfirmasi){
            $.ajax({
                type: "POST",
                dataType: "html",
                url: 'pages/pekerjaan/simpan.php',
                data:{id_alat:id_alat,id_pekerjaan:id_pekerjaan,aksi:aksi},
                success: function(data) {
                    tabel_alat();
                    pilih_alat();
                    tabel_utama();
                }
            });
        }else {
            return false;
        }
    });
</script>
