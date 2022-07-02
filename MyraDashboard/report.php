<?php
include("../MyraLogin/connection.php");
include("../MyraLogin/MyraFunctionLogin.php");
session_start();
if(!isset($_SESSION['userislogged']) || $_SESSION['userislogged'] != 1){
  header("Location: ../MyraLogin/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- graf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <!--<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
   
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> -->
  <link rel="stylesheet" href=
  "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
 
 <!-- Preloader -->
  <?php include("../MyraPreloader/preloader.php") ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="report.php" class="nav-link">Home</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  
    <!-- Sidebar -->
   <?php  include("../MyraSidebar/sidebar.php")?>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php if($_SESSION['roleid']== "1"){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <?php 
            $sql = "SELECT count(assignId) as total from myraroleassignment 
            where roleId = 1;";
            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $adminCount = $data["total"];
            
            ?>
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $adminCount; ?></h3>
                <p>Total Administrator</p>
              </div>
              <div class="icon">
                <i class="ion ion-man"></i>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <?php 
            $sql = "SELECT count(assignId) as total from myraroleassignment 
            where roleId = 2;";
            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $MoCount = $data["total"];
            
            ?>
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $MoCount; ?></h3>
                <p>Total Moderator</p>
              </div>
              <div class="icon">
                <i class="ion ion-man"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
          <?php 
            $sql = "SELECT count(sectionId) as total from myrasection;";
            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $sectionCount = $data["total"];
            
            ?>
            <!-- small box -->
            
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $sectionCount;?></h3>
                <p>Total Section</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-6">
          <?php 
            $sql = "SELECT count(subSectionId) as total from myrasubsection;";
            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $subCount = $data["total"];
            
            ?>
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3> <?php echo $subCount; ?></h3>
                <p>Total Sub-Section</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <?php 
            $sql = "SELECT count(termId) as total from myraterm;";
            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $termCount = $data["total"];
            
            ?>
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $termCount;?></h3>
                <p>Total Terms</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- <br> -->
          
              <!-- /.card-body -->
            </div>
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Monthly Search Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="myChart" style="min-height: 250px; height: 250px; width: 0px;"></canvas>
                </div>
              </div>




            <!-- ./col -->
            <?php

            // 1
            $sql1 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 1";
            $stmt1 = $conn1->prepare($sql1);
            $stmt1->execute();
            $data1 = $stmt1->fetch(PDO::FETCH_ASSOC);
            $jan = $data1["total"];
            // 2
            $sql2 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 2";
            $stmt2 = $conn1->prepare($sql2);
            $stmt2->execute();
            $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $feb = $data2["total"];
            // 3
            $sql3 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 3";
            $stmt3 = $conn1->prepare($sql3);
            $stmt3->execute();
            $data3 = $stmt3->fetch(PDO::FETCH_ASSOC);
            $march = $data3["total"];
            // 4
            $sql4 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 4";
            $stmt4 = $conn1->prepare($sql4);
            $stmt4->execute();
            $data4 = $stmt4->fetch(PDO::FETCH_ASSOC);
            $april = $data4["total"];
            // 5
            $sql5 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 5";
            $stmt5 = $conn1->prepare($sql5);
            $stmt5->execute();
            $data5 = $stmt5->fetch(PDO::FETCH_ASSOC);
            $may = $data5["total"];
            // 6
            $sql6 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 6";
            $stmt6 = $conn1->prepare($sql6);
            $stmt6->execute();
            $data6 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $june = $data6["total"];
            // 7
            $sql7 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 7";
            $stmt7 = $conn1->prepare($sql7);
            $stmt7->execute();
            $data7 = $stmt7->fetch(PDO::FETCH_ASSOC);
            $july = $data7["total"];
            // 8
            $sql8 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 8";
            $stmt8 = $conn1->prepare($sql8);
            $stmt8->execute();
            $data8 = $stmt8->fetch(PDO::FETCH_ASSOC);
            $aug = $data8["total"];
            // 9
            $sql9 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 9";
            $stmt9 = $conn1->prepare($sql9);
            $stmt9->execute();
            $data9 = $stmt9->fetch(PDO::FETCH_ASSOC);
            $sep = $data9["total"];
            // 10
            $sql10 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 10";
            $stmt10 = $conn1->prepare($sql10);
            $stmt10->execute();
            $data10 = $stmt10->fetch(PDO::FETCH_ASSOC);
            $oct = $data10["total"];
            // 11
            $sql11 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 11";
            $stmt11 = $conn1->prepare($sql11);
            $stmt11->execute();
            $data11 = $stmt11->fetch(PDO::FETCH_ASSOC);
            $nov = $data11["total"];
            // 12
            $sql12 = "SELECT count(searchDateTime) AS total FROM auditSearch WHERE MONTH(searchDateTime) = 12";
            $stmt12 = $conn1->prepare($sql12);
            $stmt12->execute();
            $data12 = $stmt12->fetch(PDO::FETCH_ASSOC);
            $dec = $data12["total"];

            ?>
            

         </div>

        <canvas id="myChart" style="width:0px;max-width:0px"></canvas>

        <script>
        var xValues = ["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"];
        var yValues = [<?php echo $jan; ?>,<?php echo $feb; ?>,<?php echo $march; ?>,<?php echo $april; ?>,<?php echo $may; ?>,<?php echo $june; ?>,<?php echo $july; ?>,<?php echo $aug; ?>,<?php echo $sep; ?>,<?php echo $oct; ?>,<?php echo $nov; ?>,<?php echo $dec; ?>];

        new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            scales: {
            yAxes: [{
                ticks: {min: 0, max:100},
                scaleLabel: {
                    display: true,
                    labelString: 'NUMBER OF SEARCHES'
                }}],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'MONTH'
                }}]
            }
        }
        });
        </script>

         <?php } else{?>

          <div class="col-lg-3 col-6">

            <?php 
              $sql = "SELECT count(sectionId) as total from myrasection;";

              $stmt = $conn1->prepare($sql);
              $stmt->execute();
              $data = $stmt->fetch(PDO::FETCH_ASSOC);

              $sectionCount = $data["total"];


              ?>

              <!-- small box -->

              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $sectionCount;?></h3>

                  <p>Total Section</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>

              </div>
            </div>

          <div class="col-lg-3 col-6">

          <?php 
            $sql = "SELECT count(subSectionId) as total from myrasubsection;";

            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $subCount = $data["total"];


            ?>

            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3> <?php echo $subCount; ?></h3>

                <p>Total Sub-Section</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->

            <?php 
            $sql = "SELECT count(termId) as total from myraterm;";

            $stmt = $conn1->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $termCount = $data["total"];


            ?>

            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $termCount;?></h3>

                <p>Total Terms</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>

          <?php } ?>

  <!-- /.row -->

        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("../MyraVersion/version.php") ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script> 
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

</body>
</html>