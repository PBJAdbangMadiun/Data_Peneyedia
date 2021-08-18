<?php
    if (isset($_POST['submit'])) {
 
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nama_bagian=addslashes(trim($_POST["nama_bagian"]));
            $tahun_anggaran=addslashes(trim($_POST["tahun_anggaran"]));
            $tanggal_kontrak=addslashes(trim($_POST["tanggal_kontrak"]));
            $provinsi=addslashes(trim($_POST["provinsi"]));
            $status_p=addslashes(trim($_POST["status_p"]));
            $status=addslashes(trim($_POST["status"]));
            $iuran_1=addslashes(trim($_POST["iuran_1"]));
            $iuran_2=addslashes(trim($_POST["iuran_2"]));
            $iuran_3=addslashes(trim($_POST["iuran_3"]));
            $kelompok=addslashes(trim($_POST["kelompok"]));

            $sql="insert into pekerjaan (nama_bagian,tahun_anggaran,tanggal_kontrak,provinsi, status_p, status, iuran1,iuran2,iuran3,kelompok) values
            ('$nama_bagian','$tahun_anggaran','$tanggal_kontrak','$provinsi', '$status_p', '$status','$iuran_1','$iuran_2','$iuran_3','$kelompok')";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=pekerjaan&tambah=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=pekerjaan&tambah=gagal");
            }
        }
    }
?>


<form action="pages/pekerjaan/tambah.php" method="post" >

    <div class="form-group">
        <label>Nama Paket:</label>
        <input type="text" name="nama_bagian" class="form-control" placeholder="Masukan nama bagian">
    </div>

    <div class="form-group">    
        <label>Tahun Anggaran:</label>
        <input type="number"  name="tahun_anggaran" class="form-control" placeholder="Masukan tahun anggaran">
    </div>
    
    <div class="form-group">
        <label>Tanggal Kontrak:</label>
        <input type="date" name="tanggal_kontrak" class="form-control" >
    </div>

    <div class="form-group">
        <label>OPD:</label>
        <select class="form-control" id="provinsi" name="provinsi" required>
        <option value="">Pilih</option>
        <?php
            include '../../config/database.php';
            $hasil = mysqli_query($kon,"select * from provinsi where isdelete='2'");
            $jumlah = mysqli_num_rows($hasil);
            while ($data = mysqli_fetch_array($hasil)) {
                ?>
                <option value="<?php echo  $data['id_prov']; ?>"><?php echo ucwords($data['nama']); ?></option>
                <?php
            }
        
            ?>
        </select>
    </div>

     <div class="form-group">
        <label>Status Pemenang:</label>
        <select class="form-control" id="status_p" name="status_p" required>
        <option value="">Pilih</option>
        <?php
            include '../../config/database.php';
            $hasil = mysqli_query($kon,"select * from status_p");
            $jumlah = mysqli_num_rows($hasil);
            while ($data = mysqli_fetch_array($hasil)) {
                ?>
                <option value="<?php echo  $data['Id_status_p']; ?>"><?php echo ucwords($data['Keterangan']); ?></option>
                <?php
            }
        ?>
        </select>
    </div>

        <!-- radio -->
        <div class="form-group">
        <label>Status : </label>
            <div class="radio">
                <label>
                <input type="radio" name="status" value="1">
                    Pekerjaan Konstruksi 
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="status" value="2">
                    Jasa Konsultansi 
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="status" value="3">
                    Jasa Lainnya
                </label>
            </div>

            <div class="radio">
                <label>
                <input type="radio" name="status" value="4">
                    Barang
                </label>
            </div>

    <div class="form-group">
        <label>Pagu Anggaran: </label>
        <input type="number" name="iuran_1" id="iuran_1" class="form-control" placeholder="Masukan Pagu Anggaran">
        <span id="nominal_iuran_1"> </span>
    </div>

    <div class="form-group">
        <label>HPS:</label>
        <input type="number" name="iuran_2" id="iuran_2" class="form-control" placeholder="Masukan HPS">
        <span id="nominal_iuran_2"> </span>
    </div>


    <div class="form-group">
        <label>Nilai Kontrak:</label>
        <input type="number" name="iuran_3" id="iuran_3" class="form-control" placeholder="Masukan Nilai Kontrak">
        <span id="nominal_iuran_3"> </span>
    </div>

    <div class="form-group">
        <label>Pilih Penyedia:</label>
        <select class="form-control" id="kelompok" name="kelompok">
        <?php
            include '../../config/database.php';
            $hasil = mysqli_query($kon,"select * from kelompok");
            $jumlah = mysqli_num_rows($hasil);
            while ($data = mysqli_fetch_array($hasil)) {
                ?>
                <option value="<?php echo  $data['id_kelompok']; ?>"><?php echo ucwords($data['nama_kelompok']); ?></option>
                <?php
            }
        
            ?>
        </select>
    </div>

    <div class="form-group col-sm-6">
        <button type="button" id="input_penyedia" class="btn btn-success">Input Penyedia Baru</button>
    </div>

    <p></p>

    <div id="tampil_kelompok"></div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
    </div>
</form>

<script>
    //Membuat format rupiah
    function format_rupiah(nominal){
        var  reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        return ribuan	= ribuan.join('.').split('').reverse().join('');
    }

    $('#iuran_1').on('keyup input propertychange paste change', function(){
        var iuran_1 = parseInt($("#iuran_1").val());
        if (iuran_1==''){
            $("#nominal_iuran_1").text('Rp.'+0); 
        }else {
            $("#nominal_iuran_1").text('Rp.'+format_rupiah(iuran_1));
        }
    });

    $('#iuran_2').on('keyup input propertychange paste change', function(){
        var iuran_2 = parseInt($("#iuran_2").val());
        if (iuran_2==''){
            $("#nominal_iuran_2").text('Rp.'+0); 
        }else {
            $("#nominal_iuran_2").text('Rp.'+format_rupiah(iuran_2));
        }
    });

    $('#iuran_3').on('keyup input propertychange paste change', function(){
        var iuran_3 = parseInt($("#iuran_3").val());
        if (iuran_3==''){
            $("#nominal_iuran_3").text('Rp.'+0); 
        }else {
            $("#nominal_iuran_3").text('Rp.'+format_rupiah(iuran_3));
        }
    });

</script>  

<script>

    $(document).ready(function(){
        tampil_kelompok();
    });

    $("#kelompok").change(function() {
        tampil_kelompok();
    });


    function tampil_kelompok(){
        var kelompok = $("#kelompok").val();

        $.ajax({
            type: "POST",
            dataType: "html",
            url: 'pages/kelompok/ambil-data.php',
            data: "kelompok=" + kelompok,
            success: function(data) {
                $("#tampil_kelompok").html(data);
            }
        });
    }
</script>

<script>
    f$('#input_penyedia').on('click',function(){
        loading();
        $("#ambil_data").show();
        $("#form_input_baru").hide();
        var id_pekerjaan=$('#id_pekerjaan').val();
        var kelompok=$("#kelompok").val();
        var aksi='input_baru';
        if (kelompok!=''){
            var id_pekerjaan=$("#id_pekerjaan").val();
            $.ajax({
                url: 'pages/kelompok/tambah.php',
                method: 'POST',
                data:{kelompok:kelompok,id_pekerjaan:id_pekerjaan,aksi:aksi},
                success:function(data){
                    ambil_data();
                    tambah();
                    tabel_utama();
                }
            }); 
        }else {
            alert('Penyedia belum dipilih');
        }

    });
</script>


