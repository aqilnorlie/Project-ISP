<?php 

include('sconnection.php'); 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Section</title>

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
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Moderator</a>
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
             <a href="Section.php" class="nav-link active">
               <i class="nav-icon fas fa-database"></i>
               <p>Section</p>
             </a>
           </li>
         </li>
         <li class="nav-item menu-open">
         <li class="nav-item">
             <a href="../MyraSubSection/Subsection.php" class="nav-link">
               <i class="nav-icon fas fa-database"></i>
               <p>Sub Section</p>
             </a>
           </li>
         </li>
         <li class="nav-item menu-open">
         <li class="nav-item">
             <a href="../MyraTerms/Terms.php" class="nav-link">
               <i class="nav-icon fas fa-database"></i>
               <p>Terms</p>
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
            <h1>Edit Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../MyraDashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Section</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div style="width:1250px" class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Section</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->

              <?php
              if(isset($_GET['sectionNumber']))
              {
                $sectionNumber = $_GET['sectionNumber'];

                $query = "SELECT * FROM myrasection WHERE token=:sectionNumber LIMIT 1";
                $statement = $pdo->prepare($query);
                $data = 
                [':sectionNumber' => $sectionNumber];
                $statement->execute($data);

                $result = $statement->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                $_SESSION["sectionNumberNew"]=$result['sectionNumber'];
                $_SESSION["dataStatusId"]=$result['dataStatusId'];
              }
              ?>

              <form action="peditsection.php" method="POST">

                <!-- <input type="hidden" name="sectionId" value="<? //= $result['sectionId']; ?>"> -->



                <div class="card-body" style="padding-top: 1em">
                  <div class="form-group">
                    <label for="sectionNumber">Section Number</label>
                    <!--(TEST) <input type="text" class="form-control" id="sectionNumber" placeholder="SELECT ONE" nama="sectionNumber"> -->
                    <!-- <div class="card-body"> amik ni dr roles -->
                      <!-- <div class="form-group"> -->
                        <!-- <label for="sectionNumber">Section Title (Malay)</label> -->

                        <!-- <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" value="<? //= $result['sectionNumber']; ?>" maxlength="1"> -->

                        <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" disabled value="<?= $_SESSION["sectionNumberNew"]; ?>">

                        <!-- <select class="form-control" name="sectionNumber" id="sectionNumber">
                          <option value="" disabled selected hidden>SELECT ONE</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                          <option value="F">F</option>
                          <option value="G">G</option>
                          <option value="H">H</option>
                        </select> -->
                      <!-- </div> -->
                    <!-- </div> -->
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionTitleMalay">Section Title (Malay)</label>
                    <input type="text" class="form-control" id="sectionTitleMalay" name="sectionTitleMalay" value="<?= $result['sectionTitleMalay']; ?>" required>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectiontitleEnglish">Section Title (English)</label>
                    <input type="text" class="form-control" id="sectionTitleEnglish" name="sectionTitleEnglish" value="<?= $result['sectionTitleEnglish']; ?>">
                  </div>
                </div>

                <!-- <div class="card-body">
                  <div class="form-group">
                    <label for="sectionHistoryProcess">Edit Process Details</label>
                    <input type="text" class="form-control" id="sectionHistoryProcess" name="sectionHistoryProcess" >
                  </div>
                </div> -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionDescription">Description</label><br>
                    <textarea name="sectionDescription" id="myTextarea" cols="150" rows="4"><?= $result['sectionDescription']; ?></textarea>
                  </div>
                </div>


                <div style="padding-left:30px; padding-top:20px; padding-bottom:20px; font-size:20px;" class="form-check">
                    <input type="hidden" name="dataStatus" value="1" />
                    <input type="checkbox" id="dataStatus" name="dataStatus" value="0" <?php if($_SESSION["dataStatusId"] == 0) echo "checked='checked'"; ?> style="width: 15px; height: 15px;">
                    <label class="form-check-label" for="dataStatus" style="padding-left:5px">Check this box to <b>HIDE</b> the data; Uncheck to <b>UNHIDE</b> the data.</label> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="submit_update" value="Save Edit" class="btn btn-primary">
                  <a href="section.php" class="btn btn-primary">Back to Add Section</a>
                  <!-- <input type="reset" value="Reset" class="btn btn-primary"> -->
                </div>
              </form>
            </div>
            
            <!-- add User form elements -->
            <!-- <div style="width:1250px"class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sections</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              <!--
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="StaffNo">Staff No</label>
                    <input type="type" class="form-control" id="StaffNo" disabled>
                  </div>
                  <div class="form-group">
                    <label for="StaffName">Staff Name</label>
                    <input type="type" class="form-control" id="StaffName" disabled>
                  </div>
                  <div class="form-group">
                    <label for="RolesStaff">Role</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <select class="form-control" name="RoleStaff" id="RoleStaff">
                          <option value="moderator">Moderator</option>
                          <option value="administrator">Administrator</option>
                      </select>
                      </div>
                  </div>

                  <div style="padding:20px" class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1"><b>Allow</b> User to access the system</label>
                  </div>
                </div>
                -->
                <!-- /.card-body --> 
                
              <!--
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div> 
                -->
                
            <!-- utk display data dlm table -->
            <?php
            //database connect
            // $host = 'localhost';
            // $dbname1 = 'myra';
            // $username = 'root';
            // $password = '';

            // $dsn = "mysql:host=$host;dbname=$dbname1;";

            // $pdo = new PDO($dsn, $username, $password);
            // $sql = "SELECT * FROM myrasection";
            // $d = $pdo->query($sql);               
            // ?>
            <!-- end display data table -->

            <!-- <div class="card" style="width:1250px">
              <div class="card-header">
                <h3 class="card-title">All Section Details</h3>
              </div> -->
              <!-- /.card-header -->
              <!-- <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Section Number</th>
                    <th>Section Title (Malay)</th>
                    <th>Section Title (English)</th>
                    <th>Section Description</th>
                    <th>USER_ID</th>
                    <th>createdAt</th>
                    <th>updatedAt</th>
                    <th>dataStatusId</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody> -->
                  <?//php foreach($d as $data)                   
                  //{
                  ?>
                  <!-- <tr>
                    <td><?//php echo $data['sectionNumber'];?></td>
                    <td><?//php echo $data['sectionTitleMalay'];?></td>
                    <td><?//php echo $data['sectionTitleEnglish'];?></td>
                    <td><?//php echo $data['sectionDescription'];?></td>
                    <td><?//php echo $data['USER_ID'];?></td>
                    <td><?//php echo $data['createdAt'];?></td>
                    <td><?//php echo $data['updatedAt'];?></td>
                    <td><?//php echo $data['dataStatusId'];?></td>
                    <td style="text-align: center;">
                      <button type="submit" class="f"><i class="fas fa-edit"></i></button>
                      <a href="#"><button type="button" class="f"><i class="fas fa-eye"></i></button></a>
                    </td>
                  </tr> -->
                  <?//php
                  //}
                  ?>
                  <!-- </tbody>
                  <tfoot>
                  <tr>
                    <th>Section Number</th>
                    <th>Section Title (Malay)</th>
                    <th>Section Title (English)</th>
                    <th>Section Description</th>
                    <th>USER_ID</th>
                    <th>createdAt</th>
                    <th>updatedAt</th>
                    <th>dataStatusId</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div> -->
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

<!--textArea plugins-->
<script src='../plugins/tinymce_6.0.2/tinymce/js/tinymce/tinymce.min.js'> </script>

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

<script>
    tinymce.init({
    selector: '#myTextarea'
});

tinymce.init({
    selector: '#myTextarea',
    width: 600,
    height: 200,
});
</script>

</body>
</html>
