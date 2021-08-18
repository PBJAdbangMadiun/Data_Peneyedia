<form action="#" id="form_alat" method="post"  enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden"  value="<?php echo $_POST['id_pekerjaan'];?>" name="id_pekerjaan" class="form-control">
    </div>
    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama_alat" class="form-control" placeholder="Masukan Nama Alat">
    </div>

    <div class="form-group">
        <label>Merek:</label>
        <input type="text" name="merek" class="form-control" placeholder="Masukan Merek">
    </div>

    <!-- radio -->
    <div class="form-group">
    <label>Status : </label>
        <div class="radio">
        <label>
        <input type="radio" name="status" value="1">
            Sewa
        </label>
        </div>
        <div class="radio">
        <label>
        <input type="radio" name="status" value="2">
            Milik Sendiri
        </label>
        </div>
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('#submit').click(function(){

            if ($('input[name="status"]:checked').length == 0) {
                    alert('Status belum diilih');
                    return false; 
                } else {
                var data = $('#form_alat').serialize();
                $.ajax({
                    type	: 'POST',
                    url	: "pages/alat/simpan.php",
                    data: data,
                    cache	: false,
                    success	: function(data){
                        tabel_alat();
                        pilih_alat();
                        tabel_utama();
                        $("#form_input_baru").hide();
                        $("#tabel_alat").show();
                    }
                });
            }
        });
    });
</script>