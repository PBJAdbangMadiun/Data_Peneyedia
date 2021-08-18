<div class="form-group">
    <select class="form-control" id="anggota" name="anggota">
    <option value="">Pilih Anggota</option>
    <?php
        include '../../config/database.php';
        $id_pekerjaan = $_POST['id_pekerjaan'];
        $hasil = mysqli_query($kon,"select * from anggota where id_anggota not in (select id_anggota from anggota_pekerjaan where id_pekerjaan='$id_pekerjaan')");
        $jumlah = mysqli_num_rows($hasil);
        while ($data = mysqli_fetch_array($hasil)) {
            ?>
            <option value="<?php echo  $data['id_anggota']; ?>"><?php echo ucwords($data['nama']); ?></option>
            <?php
        }
    
        ?>
    </select>
</div>