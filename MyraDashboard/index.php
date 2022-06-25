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

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <!--<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">-->
  <!-- iCheck -->
  <!--<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!--<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
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
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/search-modified.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MYRA</span>
    </a>

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

                <p>Total Terms <br>
                <?php $month = date('m');

            echo $_SESSION['countsearch'];
            if ($month =="January" ){
              $jan= $_SESSION['countsearch'];
              // echo "<br />December is the month :)";
            }


// $jan = session["countsearch"];
// // if xValue["januarey"] = $jan;

// }else{
// xvalue["january"] = 0;
// }else {
//   echo "<br /> The month is probably not December";
// } ?>
// </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <br><br>

          <div>
        


          
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                <script src="https://d3js.org/d3.v3.min.js"></script>
                <script src="http://gopeter.de/misc/c3/c3.js"></script>
                <script src="http://gopeter.de/misc/c3/c3.css"></script> 

                <body>
                <br><br><br><canvas id="myChart" style="width:400%;max-width:900px"></canvas>

                <br><script>
    

              <html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>

          
var xValues = ["January","February","March","April","Mei","Jun","July","August","September","October","November","Disember"];
                var yValues = [10,8,8,9,9,9,10,11,14,14,15];
  new Chart("myChart", {
  type : "line",
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
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
</script>

</body>
</html>


                


               
                

  <head>
    <script defer src="index.js"></script>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div>Total of Search:</div>
    <div class="website-counter"></div>
  </body>
</html>





          
          
          




            <!-- ./col -->
         </div>

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
  <footer class="main-footer">
    <strong>MYRA Copyright &copy; 2022-2025.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

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
<!-- Sparkline -->
<!--<script src="plugins/sparklines/sparkline.js"></script>

<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!--<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!--<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!--<script src="plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
