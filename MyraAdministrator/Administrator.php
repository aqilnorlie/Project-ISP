<?php
include("../MyraLogin/connection.php");
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

  <link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />
  <script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>

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
   <?php include("../MyraSidebar/sidebar.php")?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add User</h1>
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
            <!-- general form elements -->
            <div class="card card-primary col-sm-15">
              <div class="card-header">
                <h3 class="card-title">Search Lecturer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="Administrator.php" method="post" autocomplete = "on"> 
                <!-- <input autocomplete = "false" name ="hidden" type="text" style= "display:none" > -->
                <div class="card-body">
                  <div class="form-group">
                   
                    <label for="SearchUserID">Search</label>
                    <input type="search" class="form-control" name="SearchUserID"id="SearchUSerID" placeholder="Search by ID" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                  <button type="submit" name="btnSearchUser"class="btn btn-primary">Search</button>
                </div>
              </form>

              <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                  $data = [":id" => $_POST['SearchUserID']];
                  $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg WHERE USER_ID = :id";
                  $stmt = $conn2->prepare($sql);
                  $stmt->execute($data);
                  $rowCount = $stmt->rowCount();
                  if($rowCount > 0)
                  $nameUserAdd = "";

                  $idUserAdd = "";
                  {
                  $d = $stmt->fetch(PDO::FETCH_ASSOC);

                  if(isset($d['USER_ID']))
                  {
                    $nameUserAdd = $d['USER_NAME'];
                    $idUserAdd = $d['USER_ID'];

                    $_SESSION['idUserAdd'] = $idUserAdd;
                    $_SESSION['nameUserAdd'] = $nameUserAdd;;
                  }
                  else
                  { ?>
                    <script>
                      alert("User does not exist.");
                      window.location.href='Administrator.php';
                    </script>
                  <?php 
                  } 
                  

                }
               
              }
                
    

              ?>
            </div>
            
            <!-- add User form elements -->
            <div style="width:1250px"class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="pAdministrator.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="StaffNo">Staff No</label>
                    <input type="type" class="form-control" id="StaffNo" value="<?php 

                   
                    
                    if(!isset($idUserAdd)){

                      echo"";

                    }else{
                      echo $idUserAdd;
                    }

                   
                
                    
                      ?>" disabled >

                  </div>

                  <div class="form-group">
                    <label for="StaffName">Staff Name</label>
                    <input type="type" class="form-control" id="StaffName" value="<?php 
                    
                    if(!isset($nameUserAdd)){
                      echo"";

                    }else{
                      echo $nameUserAdd;
                   }

                      ?>"disabled>
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
                        <select class="form-control" name="RoleStaff" id="RoleStaff" required>
                           <option value="" disabled selected hidden>--Choose Role--</option> 
                          
                          <?php
                           foreach($data as $d) { ?>
                          <option value=<?php echo $d["roleId"]; ?>><?php echo $d["roleTitle"];?></option>
                          


                          <?php } ?>
                          
                      </select>
                      </div>
                  </div>

                  <div style="padding:20px" class="form-check">
                    <input type="radio" name="checkAccess" class="form-check-input" id="exampleCheck1"  value="1" required>
                    <label class="form-check-label" for="exampleCheck1"><b>Allow</b> User to access the system</label><br>

                    <input type="radio" name="checkAccess"class="form-check-input" id="exampleCheck2" value="0" required>
                    <label class="form-check-label" for="exampleCheck2"><b>Don't Allow</b> User to access the system</label>
                  </div>
                </div>
                <!-- /.card-body --> 

                <div class="card-footer">
                  <button type="submit" name="btnAddUser"class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

              <?php 
                  $sql = "SELECT M.statusId , R.roleTitle, C.USER_ID, C.USER_NAME, M.createdAt, M.updatedAt, M.token from myra.myraroleassignment M JOIN 
                  classbook_backup_jengka.vw_staff_phg C on M.USER_ID = C.USER_ID JOIN 
                  myra.myraroles R on M.roleId = R.roleId WHERE M.USER_ID = C.USER_ID";

                  $d = $conn1->query($sql);
                  
                  ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data All User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table1">

                <table id="example2" class="table table-bordered table-hover table2">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Staff No</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th>Date</th>
                    <th>Update</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                   $count = 1;
                   foreach($d as $data)
                   {
                    
                    ?>
                   
                    <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $data["USER_ID"]; ?></td>
                    <td><?php echo $data["USER_NAME"]; ?></td>
                    <td><?php echo $data["roleTitle"]; ?></td>
                    <td><?php echo $data["createdAt"]; ?></td>
                    <td>
                      <?php
                      if(!isset($data["updatedAt"])){
                        echo "---";
                      }else{
                        echo $data["updatedAt"];
                      } ?>
                    </td>
                    <td style="text-align:center;">

                    <form action="AdministratorEdit.php?assignId=<?= $data['token']; ?>"  method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="edit" class="f"><i class="fas fa-edit" title="Edit User"></i></button>
                    </form>

                    
                    <form action="AdministratorView.php?assignId=<?=$data['token'];?>" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="view" class="f"><i class="fas fa-eye" title="View User"></i></button>
                    </form>

                    <form action="AdministratorDelete.php?assignId=<?=$data['token'];?>" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="Delete" class="delete"><i class="fas fa-trash" title="View User"></i></button>
                    </form>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Staff No</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th>Date</th>
                    <th>Update</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
    "bJQueryUI":true,
    "bSort":true,
    "bSortable": true,
    "bPaginate":true,
    "sPaginationType":"full_numbers",
      "iDisplayLength": 5
  });
});
</script>

</body>
</html>
