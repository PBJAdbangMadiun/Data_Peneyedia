<div class="form-group">
    <select class="form-control" id="alat" name="alat">
    <option value="">Pilih alat</option>
    <?php
        include '../../config/database.php';
        $id_pekerjaan = $_POST['id_pekerjaan'];
        $hasil = mysqli_query($kon,"select * from alat where id_alat not in (select id_alat from alat_pekerjaan where id_pekerjaan='$id_pekerjaan')");
        $jumlah = mysqli_num_rows($hasil);
        while ($data = mysqli_fetch_array($hasil)) {
            ?>
            <option value="<?php echo  $data['id_alat']; ?>"><?php echo ucwords($data['nama_alat']); ?></option>
            <?php
        }
    
        ?>
    </select>
</div>