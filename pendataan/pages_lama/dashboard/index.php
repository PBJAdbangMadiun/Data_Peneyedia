<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Dashboard
    <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
        <?php
            $hari_ini = date('Y-m-d');
            include 'config/database.php';
            $hasil=mysqli_query($kon,"select * from anggota where tanggal='".$hari_ini."'");
            $jum = mysqli_num_rows($hasil);
        ?>
        <div class="info-box-content">
            <span class="info-box-text">Pendaftaran Hari Ini</span>
            <h2><span class="info-box-number"> <?php echo $jum; ?></span></h2>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
        <?php
            $kemarin = date ("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d"))));
            $hasil=mysqli_query($kon,"select * from anggota where tanggal='".$kemarin."'");
            $jum = mysqli_num_rows($hasil);
        ?>
        <div class="info-box-content">
            <span class="info-box-text">Pendaftaran Kemarin</span>
            <h2><span class="info-box-number"> <?php echo $jum; ?></span></h2>
         
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
        <?php

            $bulan_ini = date("m");
            $hasil=mysqli_query($kon,"select * from anggota where month(tanggal)='".$bulan_ini."' and year(tanggal)='".date('Y')."'");
            $jum = mysqli_num_rows($hasil);
        ?>
        <div class="info-box-content">
            <span class="info-box-text">Pendaftaran Bulan ini</span>
            <h2><span class="info-box-number"> <?php echo $jum; ?></span></h2>
        
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
        <?php
    
            $hasil=mysqli_query($kon,"select * from anggota");
            $jum = mysqli_num_rows($hasil);
        ?>
        <div class="info-box-content">
            <span class="info-box-text">Total Pendaftaran</span>
            <h2><span class="info-box-number"> <?php echo $jum; ?></span></h2>
         
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
    <div class="col-md-12">
        <div class="box">
        <div class="box-header with-border">
         
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <p class="text-center">
                <strong>Anggota Berdasarkan Provinsi</strong>
                </p>
                <div style="width: 100%">
                    <canvas id="canvas" height="250" width="600"></canvas>
                </div>

                <!-- /.chart-responsive -->
            </div>
           
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- ./box-body -->
        <div class="box-footer">
  
        </div>
        <!-- /.box-footer -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
    <!-- Left col -->

    <div class="col-md-6">
        <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Anggota Berdasarkan Jenis</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
            <div class="col-md-8">
                <div class="chart-responsive">
                <canvas id="pieChartPemasukan" height="200"></canvas>
                </div>
                <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <ul class="chart-legend clearfix">
                <?php
                    include 'config/database.php';
                    $i=0;
                    $jenis="";
                    $warna = ['#007bff', '#dc3545', '#ffc107', '#28a745','#53ff1a','#ff9900','#7300e6','#75a3a3','#99994d','#ac3939','#66b3ff','#ac7339','#ff00ff'];
                    $sql="select a.jenis,count(*) from anggota a group by a.jenis order by a.jenis asc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($data = mysqli_fetch_array($hasil)):
                    
                        if ($data['jenis']==1){
                            $jenis="Koordinator Utama";
                        }else if ($data['jenis']==2){
                            $jenis="Koordinator";
                        }else if ($data['jenis']==3){
                            $jenis="Anggota";
                        }
                ?>
                <li><i style="color:<?php echo $warna[$i];?>" class="fa fa-circle-o"></i> <span ><?php echo $jenis; ?><span></li>
    
                <?php $i++;
                endwhile; ?>
                </ul>
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script>
$(function () {

'use strict';

/* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */

// -----------------------
// - MONTHLY SALES CHART -
// -----------------------

// ---------------------------
// - END MONTHLY SALES CHART -
// ---------------------------

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var warna = ['#007bff', '#dc3545', '#ffc107', '#28a745','#53ff1a','#ff9900','#7300e6','#75a3a3','#99994d','#ac3939','#66b3ff','#ac7339','#ff00ff'];
  var pieChartCanvas = $('#pieChartPemasukan').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    <?php
        include 'config/database.php';
        $i=0;
        $sql="select a.jenis,count(*) as total from anggota a group by a.jenis order by a.jenis asc";
        $hasil=mysqli_query($kon,$sql);
        while ($data = mysqli_fetch_array($hasil)) {
            if ($data['jenis']==1){
                $jenis="Koordinator Utama";
            }else if ($data['jenis']==2){
                $jenis="Koordinator";
            }else if ($data['jenis']==3){
                $jenis="Anggota";
            }
    ?>
            {
                
                value    : <?php echo $data['total'];?>,
                color    : warna[<?php echo $i; ?>],
                label    : '<?php echo $jenis;?>'
            },
        <?php
         $i++;
        }
    ?>
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=label%> : <%=value %>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------

  // -------------
  // - PIE CHART -
  // -------------
 

});
</script>
<?php 
    include 'config/database.php';
    $i=0;
    $sql="select p.nama as provinsi, count(id_anggota) as total
    from provinsi p
    left join anggota a on p.id_prov=a.provinsi
    group by p.nama";
    $hasil=mysqli_query($kon,$sql);
    while ($data = mysqli_fetch_array($hasil)) {
        $total[] = $data['total'];
        $provinsi[] = $data['provinsi'];
    }
?>

<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : <?php echo json_encode($provinsi); ?>,
		datasets : [
			{
				fillColor : "#0080ff",
				strokeColor : "#0080ff",
				highlightFill: "#1a8cff",
				highlightStroke: "#0080ff",
				data :  <?php echo json_encode($total); ?>
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>