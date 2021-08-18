<div class="row">
    <div class="col-sm-6">
        <div id="pilih_alat"></div>

    </div>
    <div class="col-sm-6">
        <button type="button" id="tambah_alat" class="btn btn-primary">Tambah</button>
    </div>
</div>

<div class="form-group">
    <input type="hidden" name="id_pekerjaan" id="id_pekerjaan" class="form-control" value="<?php echo $_POST['id_pekerjaan'];?>" >
</div>
<div id="tabel_alat"> </div>


<script>

    $(document).ready(function(){
        tabel_alat();
        pilih_alat();
    });


    function pilih_alat(){
        var id_pekerjaan=$("#id_pekerjaan").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/alat/pilih-alat.php',
            data:{id_pekerjaan:id_pekerjaan},
            success: function(data) {
                $("#pilih_alat").html(data);
            }
        });
    }

    function tabel_alat(){
        var alat=$("#alat").val();
        var id_pekerjaan=$("#id_pekerjaan").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/alat/tabel-alat.php',
            data:{alat:alat,id_pekerjaan:id_pekerjaan},
            success: function(data) {
                $("#tabel_alat").html(data);
            }
        });
    }

    //Event saat tombol tambah diklik
    $('#tambah_alat').on('click',function(){
        loading();
        var alat=$("#alat").val();
        var aksi='tambah-alat';
        if (alat!=''){
            var id_pekerjaan=$("#id_pekerjaan").val();
            $.ajax({
                url: 'pages/pekerjaan/simpan.php',
                method: 'POST',
                data:{alat:alat,id_pekerjaan:id_pekerjaan,aksi:aksi},
                success:function(data){
                    tabel_alat();
                    pilih_alat();
                    tabel_utama();
                }
            }); 
        }else {
            alert('Alat belum dipilih');
        }

    });



</script>

