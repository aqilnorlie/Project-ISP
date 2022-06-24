<?php
include("../MyraLogin/connection.php");
//include("../MyraSection/sconnection.php");
include("../MyraLogin/MyraFunctionLogin.php");
session_start();
//$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');

if(!isset($_SESSION['userislogged']) || $_SESSION['userislogged'] != 1){
  header("Location: ../MyraLogin/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="../Mystyle.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php

if($_GET['assignId'] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_GET['assignId']) && checkReportToken($conn1, $_GET['assignId']) == false) 
{
    header("Location: administrator.php?warning4");
} 

function checkReportToken($pdo, $token)
{
    $found = false;
    $data = [":token" => $token];
    $sql = "SELECT token FROM myraroleassignment WHERE BINARY token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}
?>

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav  class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../MyraDashboard/index.php" class="nav-link">Home</a>
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
    <a href="../MyraDashboard/index.php" class="brand-link">
      <img src="../dist/img/search-modified.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MYRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
           
              <li class="nav-item">
                <a href="../MyraDashboard/index.php" class="nav-link">
                  <i class="nav-icon fas fa-home"></i></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </li>
          <li class="nav-item menu-open">
          <li class="nav-item">
             <a href="Administrator.php" class="nav-link active">
               <i class="nav-icon fas fa-user-graduate"></i>
               <p>User</p>
             </a>
           </li>
         </li>
         <li class="nav-item menu-open">
         <li class="nav-item">
             <a href="../MyraReport/report.php" class="nav-link">
               <i class="nav-icon fas fa-chart-line"></i>
               <p>Report</p>
             </a>
           </li>
         </li>
          <li class="nav-item">
            <a href="../MyraLogin/login.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-15">
            
            
            <!-- add User form elements -->
            <div style="width:1250px"class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <?php

              if(isset($_GET['assignId'])){

                $assignId = $_GET['assignId'];
                $data = [':assignId' => $assignId];
              
                $sql = "SELECT * from  myra.myraroleassignment m Join classbook_backup_jengka.vw_staff_phg C ON 
                m.USER_ID = C.USER_ID Join myra.myraroles r ON m.roleId = r.roleId where m.Token = :assignId limit 1";

                $stmt = $conn1 -> prepare($sql);
                $stmt->execute($data);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['assignIdNew'] = $result["assignId"];
               
                
              }

              ?>

              <form action="pAdministratorEdit.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="StaffNo">Staff No</label>
                    <input type="type" class="form-control" id="StaffNo" value=" <?php echo $result["USER_ID"] ?>" disabled >

                  </div>

                  <div class="form-group">
                    <label for="StaffName">Staff Name</label>
                    <input type="type" class="form-control" id="StaffName" value="<?php echo $result["USER_NAME"]?>" disabled>
                  </div>

                  <div class="form-group">
                    <label for="RolesStaff">Role</label>
                    <div class="input-group">
                      <div class="custom-file">

                      <?php
                        $sql = "SELECT * From myraroles ";
                        
                        $stmt = $conn1->prepare($sql);

                        $stmt->execute();
                        $data = $stmt->fetchAll();

                      ?>
                        <select class="form-control" name="RoleStaff" id="RoleStaff">
                           <option value="" disabled selected hidden><?php echo $result["roleTitle"] ?></option> 
                          
                          <?php
                           foreach($data as $d) { ?>
                          <option value=<?php echo $d["roleId"]; ?>><?php echo $d["roleTitle"];?></option>
                          


                          <?php } ?>
                          
                      </select>
                      </div>
                  </div>

                  <div style="padding:20px" class="form-check">
                    <input type="radio" name="checkAccess" class="form-check-input" id="exampleCheck1"  value="1" <?php if($result["statusId"] ==1)  echo "checked='checked'";?>>
                    <label class="form-check-label" for="exampleCheck1"><b>Allow</b> User to access the system</label><br>

                    <input type="radio" name="checkAccess"class="form-check-input" id="exampleCheck2" value="0" <?php if($result["statusId"] == 0)echo "checked='checked'"; ?> >
                    <label class="form-check-label" for="exampleCheck2"><b>Don't Allow</b> User to access the system</label>
                  </div>
                </div>
                    <!-- /.card-body --> 

                    <div class="card-footer">
                        <button type="submit" name="btnEditUser"class="btn btn-primary">Edit</button>
                        <a href="Administrator.php" class="btn btn-primary">Back</a>
                    </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
       
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
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
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
