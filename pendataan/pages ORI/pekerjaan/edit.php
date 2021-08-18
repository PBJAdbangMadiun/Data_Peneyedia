<?php
    if (isset($_POST['submit'])) {
        //Memulai session
        session_start();
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $id_pekerjaan=addslashes(trim($_POST["id_pekerjaan"]));
            $nama_bagian=addslashes(trim($_POST["nama_bagian"]));
            $tahun_anggaran=addslashes(trim($_POST["tahun_anggaran"]));
            $tanggal_kontrak=addslashes(trim($_POST["tanggal_kontrak"]));
            $provinsi=addslashes(trim($_POST["provinsi"]));
            $status=addslashes(trim($_POST["status"]));
            $iuran_1=addslashes(trim($_POST["iuran_1"]));
            $iuran_2=addslashes(trim($_POST["iuran_2"]));
            $iuran_3=addslashes(trim($_POST["iuran_3"]));
            $kelompok=addslashes(trim($_POST["kelompok"]));
    
            $sql="update pekerjaan set
            nama_bagian='$nama_bagian',
            tahun_anggaran='$tahun_anggaran',
            tanggal_kontrak='$tanggal_kontrak',
            provinsi='$provinsi',
            status='$status',
            iuran1='$iuran_1',
            iuran2='$iuran_2',
            iuran3='$iuran_3',
            kelompok='$kelompok'
            where id_pekerjaan='$id_pekerjaan'";

            $simpan=mysqli_query($kon,$sql);

            if ($simpan) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=pekerjaan&edit=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=pekerjaan&edit=gagal");
            }
        }
    }
?>

<?php
    $id_pekerjaan=$_POST["id_pekerjaan"];
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM pekerjaan where id_pekerjaan=$id_pekerjaan");
    $data = mysqli_fetch_array($query); 
?>
<form action="pages/pekerjaan/edit.php" method="post" >

<div class="form-group">
    <input type="hidden" name="id_pekerjaan" value="<?php echo $data['id_pekerjaan'];?>" class="form-control">
</div>

<div class="form-group">
    <label>Nama Bagian:</label>
    <input type="text" name="nama_bagian" value="<?php echo $data['nama_bagian'];?>" class="form-control" placeholder="Masukan nama bagian">
</div>

<div class="form-group">
        <label>Tahun Anggaran:</label>
        <input type="number"  name="tahun_anggaran" value="<?php echo $data['tahun_anggaran'];?>" class="form-control" placeholder="Masukan tahun anggaran">
    </div>

    <div class="form-group">
        <label>Tanggal Kontrak:</label>
        <input type="date" name="tanggal_kontrak" value="<?php echo $data['tanggal_kontrak'];?>" class="form-control" >
    </div>

<div class="form-group">
    <label>Provinsi:</label>
    <select class="form-control" id="provinsi" name="provinsi">
    <option value="">Pilih</option>
    <?php
        include '../../config/database.php';
        $hasil = mysqli_query($kon,"select * from provinsi ");
        $jumlah = mysqli_num_rows($hasil);
        while ($row = mysqli_fetch_array($hasil)) {
            ?>
            <option <?php if ($data['provinsi']==$row['id_prov']) echo "selected"; ?> value="<?php echo  $row['id_prov']; ?>"><?php echo ucwords($row['nama']); ?></option>
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
            <input type="radio" name="status" <?php if ($data['status']=='1') echo "checked";?> value="1">
                Berjalan 
            </label>
        </div>
        <div class="radio">
            <label>
            <input type="radio" name="status"  <?php if ($data['status']=='2') echo "checked"; ?> value="2">
                Cadangan 
            </label>
        </div>
        <div class="radio">
            <label>
            <input type="radio" name="status"  <?php if ($data['status']=='3') echo "checked"; ?> value="3">
                Dibatalkan 
            </label>
        </div>
    </div>


<div class="form-group">
    <label>Iuran 1: </label>
    <input type="number" name="iuran_1" value="<?php echo $data['iuran1'];?>" id="iuran_1" class="form-control" placeholder="Masukan iuran 1">
    <span id="nominal_iuran_1"> </span>
</div>

<div class="form-group">
    <label>Iuran 2:</label>
    <input type="number" name="iuran_2" id="iuran_2" value="<?php echo $data['iuran2'];?>" class="form-control" placeholder="Masukan iuran 2">
    <span id="nominal_iuran_2"> </span>
</div>


<div class="form-group">
    <label>Iuran 3:</label>
    <input type="number" name="iuran_3" id="iuran_3" value="<?php echo $data['iuran3'];?>" class="form-control" placeholder="Masukan iuran 3">
    <span id="nominal_iuran_3"> </span>
</div>

<div class="form-group">
    <label>Pilih Kelompok:</label>
    <select class="form-control" id="kelompok" name="kelompok">
    <?php
        include '../../config/database.php';
        $hasil = mysqli_query($kon,"select * from kelompok");
        $jumlah = mysqli_num_rows($hasil);
        while ($row = mysqli_fetch_array($hasil)) {
            ?>
            <option <?php if ($data['kelompok']==$row['id_kelompok']) echo "selected"; ?>  value="<?php echo  $row['id_kelompok']; ?>"><?php echo ucwords($row['nama_kelompok']); ?></option>
            <?php
        }
    
        ?>
    </select>
</div>

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


