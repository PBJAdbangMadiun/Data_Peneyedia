<?php 
  session_start();
  if (!$_SESSION["id_pengguna"]){
        header("Location:login.php?auth=harus_login");
      
  }else {

    include 'config/database.php';
    $id_pengguna=$_SESSION["id_pengguna"];
    $username=$_SESSION["username"];

    $hasil=mysqli_query($kon,"select * from pengguna where id_pengguna=$id_pengguna");
    $pengguna = mysqli_fetch_array($hasil); 
    $username_db=$pengguna['username'];
    $nama_pengguna=$pengguna['nama_pengguna'];
    $foto=$pengguna['foto'];

    if ($username!=$username_db){
        session_unset();
        session_destroy();
        header("Location:login.php?auth=harus_login");
    }
  }
?>

<?php 
  include 'config/database.php';
  $hasil=mysqli_query($kon,"select * from profil_aplikasi order by nama_aplikasi desc limit 1");
  $aplikasi = mysqli_fetch_array($hasil); 
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css"> 
 #mapa {
 margin: 10px;
 width: 100%;
 height: 400px; 
 padding: 10px;
 }
 </style>
<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyA3zXAgDW7B_A3cBo8tb7fcXIxYCWsXXuE" type="text/javascript"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $aplikasi['nama_aplikasi'];?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- adminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="dist/font/font.css">
       
</head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?page=dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">DP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $aplikasi['nama_aplikasi'];?></b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top navbar-fixed-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="pages/pengguna/foto/<?php echo $foto; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"> <?php echo ucfirst($nama_pengguna); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="pages/pengguna/foto/<?php echo $foto; ?>" class="img-circle" alt="User Image">

                <p>
                <?php echo ucfirst($nama_pengguna); ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?page=profil" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" id="logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="pages/pengguna/foto/<?php echo $foto; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($nama_pengguna); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group input-group-sm" style="width: 200px">
          <input class= "form-control" type="text" name="table_search" id="kata_kunci" class="form-control pull-right" placeholder="Search...">
            <div class="input-group-btn">
                <button type="button" name="search" id="tombol_cari" class="btn btn-default"><i class="fa fa-search"></i>
                </button>
                <div id="SELECT * FROM pekerjaan ;"> </div>
            </div>
        </div>
      </form>
      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="index.php?page=dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>
        <li><a href="index.php?page=pekerjaan"><i class="fa fa-briefcase"></i> <span>Pekerjaan</span></a></li>   
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="index.php?page=kelompok"><i class="fa fa-th-large"></i> <span>Penyedia</span></a></li>
              <li><a href="index.php?page=anggota"><i class="fa fa-users"></i> <span>Tenaga Ahli</span></a></li>
              <li><a href="index.php?page=alat"><i class="fa fa-anchor"></i> <span>Alat</span></a></li>
              <li><a href="index.php?page=provinsi"><i class="fa fa-anchor"></i> <span>Perangkat Daerah</span></a></li>
          </ul>
        </li>
        <?php if ($_SESSION["level"]=='Admin' and $_SESSION["level"]!='admin'): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="index.php?page=pengguna"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
              <li><a href="index.php?page=pengaturan"><i class="fa fa-cog"></i> <span>Pengaturan</span></a></li>   
          </ul>
        </li> 
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php 
      if(isset($_GET['page'])){
        $page = $_GET['page'];
    
        switch ($page) {
              case 'dashboard':
                  include "pages/dashboard/index.php";
                  break;
              case 'pekerjaan':
                include "pages/pekerjaan/index.php";
                break;
              case 'kelompok':
                include "pages/kelompok/index.php";
                break;
              case 'anggota':
                include "pages/anggota/index.php";
                break;
              case 'alat':
                include "pages/alat/index.php";
                break;
              case 'provinsi':
                include "pages/provinsi/index.php";
                break;
              case 'profil':
                include "pages/profil/index.php";
                break;
              case 'pengguna':
                include "pages/pengguna/index.php";
                break;
              case 'pengaturan':
                include "pages/pengaturan-aplikasi/index.php";
                break;
          default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
      }
  ?>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer navbar-fixed-bottom">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y');?> <?php echo $aplikasi['nama_aplikasi'];?>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">

        <!-- /.control-sidebar-menu -->


        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- penggunaLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- penggunaLTE dashboard demo (This is only for demo purposes) -->
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- penggunaLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

<script>
   // fungsi hapus jadwal
   $('#logout').on('click',function(){
        konfirmasi=confirm("Apakah anda yakin ingin keluar?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

