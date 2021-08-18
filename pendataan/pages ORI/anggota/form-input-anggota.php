<form action="#" id="form_anggota" method="post"  enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden"  value="<?php echo $_POST['id_pekerjaan'];?>" name="id_pekerjaan" class="form-control">
    </div>
    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Pendidikan:</label>
        <select class="form-control" id="pendidikan" name="pendidikan">
            <option value="SLTA">SLTA/Sederajat</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <textarea class="form-control" rows="3" name="alamat" id="alamat"></textarea>
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('#submit').click(function(){
            var data = $('#form_anggota').serialize();
            $.ajax({
                type	: 'POST',
                url	: "pages/anggota/simpan.php",
                data: data,
                cache	: false,
                success	: function(data){
                    tabel_anggota();
                    pilih_anggota();
                    tabel_utama();
                    $("#form_input_baru").hide();
                    $("#tabel_anggota").show();
                }
            });
        });
    });
</script>