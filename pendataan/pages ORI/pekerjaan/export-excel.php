<?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=LAPORAN PEKERJAAN.xls");
?>
<table border="1">
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Bagian</th>
        <th class="text-center">Status</th>
        <th class="text-center">Kelompok</th>
        <th class="text-center">Pengurus</th>
        <th class="text-center">Iuran</th>
        <th class="text-center">Anggota</th>
        <th class="text-center">Alat</th>
    </tr>
    <?php
        include '../../config/database.php';
    
        if ($_GET['status']!='' and $_GET['kata_kunci']!=''){
            $sql="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.id_prov=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.status='".$_GET['status']."' and (p.nama_bagian like '%".$_GET['kata_kunci']."%' or n.nama like '%".$_GET['kata_kunci']."%' or k.nama_kelompok like '%".$_GET['kata_kunci']."%' or t.nama like '%".$_GET['kata_kunci']."%') order by p.id_pekerjaan desc";
        }else if ($_GET['status']!='' and $_GET['kata_kunci']==''){
            $sql="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.id_prov=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.status='".$_GET['status']."' order by p.id_pekerjaan desc";
        } else if ($_GET['status']=='' and $_GET['kata_kunci']!=''){
            $sql="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.id_prov=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota where p.nama_bagian like '%".$_GET['kata_kunci']."%' or n.nama like '%".$_GET['kata_kunci']."%' or k.nama_kelompok like '%".$_GET['kata_kunci']."%' or t.nama like '%".$_GET['kata_kunci']."%' order by p.id_pekerjaan desc";
        } else {
            $sql="select distinct p.*,n.nama as nama_provinsi from pekerjaan p left join provinsi n on n.id_prov=p.provinsi left join kelompok k on k.id_kelompok=p.kelompok left join anggota_pekerjaan a on a.id_pekerjaan=p.id_pekerjaan left join anggota t on t.id_anggota=a.id_anggota order by p.id_pekerjaan desc";
        }
    
        $hasil=mysqli_query($kon,$sql);
        $no=0;

        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
        $no++;
        $sql="select * from kelompok k inner join pekerjaan p on p.kelompok=k.id_kelompok where p.id_pekerjaan='".$data['id_pekerjaan']."'";
        $result=mysqli_query($kon,$sql);
        $row = mysqli_fetch_array($result);
    ?>
    <tr>
        <td> <?php echo $no; ?> </td>
        <td>
        <?php echo ucwords($data['nama_bagian']); ?> <br>
        <?php echo $data['nama_provinsi']; ?><br>
        </td>
        <td> 
        <?php 
            if ($data['status']==1){
                echo "<span>Berjalan</span>";
            }else if ($data['status']==2){
                echo "<span>Cadangan</span>";
            }else if ($data['status']==3){
                echo "<span>Dibatalkan</span>";
            }
        ?>
        </td>
        <td> 
            <?php echo ucwords($row['nama_kelompok']); ?> <br>
            <?php echo "Alamat : ".$row['alamat']; ?><br>
            <?php echo "Telp : ".$row['no_telp']; ?>
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
    </tr>
    <?php endwhile; ?>
</table>