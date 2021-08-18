<table id="example1" class="table table-striped table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Pendidikan</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php

        $id_pekerjaan = $_POST['id_pekerjaan'];
   
        include '../../config/database.php';
        $sql="select * from anggota a inner join anggota_pekerjaan p on a.id_anggota=p.id_anggota where p.id_pekerjaan='".$id_pekerjaan."'";
        $hasil=mysqli_query($kon,$sql);
        $no=0;

        $jumlah = mysqli_num_rows($hasil);

        if ($jumlah<=0){
           echo "<div class='alert alert-info'> Anggota belum ditambahkan</div>";
        }

        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
        $no++;
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['pendidikan']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td>
        <button class="tombol_hapus_anggota btn btn-danger btn-circle" id_anggota="<?php echo $data['id_anggota']; ?>" id_pekerjaan="<?php echo $id_pekerjaan; ?>"  ><i class="fa fa-trash"></i></button>
        </td>

       
    </tr>
    <?php endwhile; ?>
</table>

<script>

$('.tombol_hapus_anggota').on('click',function(){
        var id_anggota = $(this).attr("id_anggota");
        var id_pekerjaan = $(this).attr("id_pekerjaan");
        var aksi='hapus-anggota';
        konfirmasi=confirm("Yakin ingin menghapus anggota ini ?")
        if (konfirmasi){
            $.ajax({
                type: "POST",
                dataType: "html",
                url: 'pages/pekerjaan/simpan.php',
                data:{id_anggota:id_anggota,id_pekerjaan:id_pekerjaan,aksi:aksi},
                success: function(data) {
                    tabel_anggota();
                    pilih_anggota();
                    tabel_utama();
                }
            });
        }else {
            return false;
        }
    });
</script>
