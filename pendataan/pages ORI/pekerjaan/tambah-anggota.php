<div class="row">
    <div class="col-sm-6">
        <div id="pilih_anggota"></div>

    </div>
    <div class="col-sm-6">
        <button type="button" id="tambah_anggota" class="btn btn-primary">Tambah</button>
        <button type="button" id="input_baru" class="btn btn-success">Input Baru</button>
    </div>
</div>

<div class="form-group">
    <input type="hidden" name="id_pekerjaan" id="id_pekerjaan" class="form-control" value="<?php echo $_POST['id_pekerjaan'];?>" >
</div>

<div id="form_input_baru"> </div>

<div id="tabel_anggota"> </div>

<script>

    $(document).ready(function(){
        tabel_anggota();
        pilih_anggota();
    });


    function pilih_anggota(){
        var id_pekerjaan=$("#id_pekerjaan").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/anggota/pilih-anggota.php',
            data:{id_pekerjaan:id_pekerjaan},
            success: function(data) {
                $("#pilih_anggota").html(data);
            }
        });
    }

    function tabel_anggota(){
        var anggota=$("#anggota").val();
        var id_pekerjaan=$("#id_pekerjaan").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/anggota/tabel-anggota.php',
            data:{anggota:anggota,id_pekerjaan:id_pekerjaan},
            success: function(data) {
                $("#tabel_anggota").html(data);
            }
        });
    }

    //Event saat tombol tambah diklik
    $('#tambah_anggota').on('click',function(){
        loading();
        $("#tabel_anggota").show();
        $("#form_input_baru").hide();
        var anggota=$("#anggota").val();
        $("#form_input_baru").hide();
        if (anggota!=''){
            var id_pekerjaan=$("#id_pekerjaan").val();
            $.ajax({
                url: 'pages/pekerjaan/simpan.php',
                method: 'POST',
                data:{anggota:anggota,id_pekerjaan:id_pekerjaan},
                success:function(data){
                    tabel_anggota();
                    pilih_anggota();
                    tabel_utama();
                }
            }); 
        }else {
            alert('Anggota belum dipilih');
        }

    });

    
    //Event saat tombol tambah diklik
    $('#input_baru').on('click',function(){
        loading();
        $("#tabel_anggota").hide();
        $("#form_input_baru").show();
        var id_pekerjaan=$("#id_pekerjaan").val();
        $.ajax({
            url: 'pages/anggota/form-input-anggota.php',
            method: 'POST',
            data:{id_pekerjaan:id_pekerjaan},
            success:function(data){
                $('#form_input_baru').html(data);  
            }
        }); 
    });

</script>

