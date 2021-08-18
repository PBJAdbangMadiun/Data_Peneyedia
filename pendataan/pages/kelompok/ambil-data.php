<table id="example1" class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>NPWP</th>
        <th>Direktur</th>
        <th>Komanditer</th>
    </tr>
    <?php
        $kelompok= $_POST['kelompok'];
        include '../../config/database.php';
        $sql="select * from kelompok where id_kelompok='".$kelompok."'";
        $hasil=mysqli_query($kon,$sql);
        $no=0;

        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
        $no++;
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $data['nama_kelompok']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['no_telp']; ?></td>
        <td><?php echo $data['ketua']; ?></td>
        <td><?php echo $data['wakil']; ?></td>   
    </tr>
    <?php endwhile; ?>
</table>