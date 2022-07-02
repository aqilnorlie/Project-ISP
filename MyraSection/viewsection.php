<?php 

include("../MyraLogin/connection.php");
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
  <title>View Section</title>

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

  <style>
    .card-body{
      padding-bottom: 0.1em;
    }

    .form-group{
      margin-bottom: 0.5em;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php

// kalau url token ditukar (token yg takde dlm database)
// if(isset($_GET['id'])            && checkReportToken($dbh, $_SESSION['userid'], $_GET['id']) == false)

if($_GET['sectionNumber'] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_GET['sectionNumber']) && checkReportToken($conn1, $_SESSION['userid'], $_GET['sectionNumber']) == false) 
{
    header("Location: Section.php?warning");
} 

function checkReportToken($conn1, $userid, $token)
{
    $found = false;
    $data = [":userid" => $userid, ":token" => $token];
    $sql = "SELECT token FROM myrasection WHERE USER_ID = :userid AND BINARY token = :token";
    $stmt = $conn1->prepare($sql);
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
  <?php include("../MyraPreloader/preloader.php") ?>
  <!-- Navbar -->
  <nav  class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../MyraDashboard/report.php" class="nav-link">Home</a>
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
            <h1>View Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../MyraDashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">View Section</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div style="width:1250px" class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">View Section</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->

              <?php
              if(isset($_GET['sectionNumber']))
              {
                $sectionNumber = $_GET['sectionNumber'];

                $query = "SELECT * FROM myrasection m 
                JOIN datastatus d 
                ON d.dataStatusId = m.dataStatusId 
                WHERE token=:sectionNumber";

                $sql_username = "SELECT * FROM myra.myrasection m 
                JOIN classbook_backup_jengka.vw_staff_phg c 
                ON c.USER_ID = m.USER_ID";

              
                $statement = $conn1->prepare($query);
                $stmt_username = $conn1->prepare($sql_username);
               
                
                $data = [':sectionNumber' => $sectionNumber];
                
                $statement->execute($data);
                $stmt_username->execute();
                

                $result = $statement->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                $result_username = $stmt_username->fetch(PDO::FETCH_ASSOC);
                
                
                $_SESSION["sectionNumberNew"]=$result['sectionNumber'];
                $_SESSION["sectionDescription"]=$result['sectionDescription'];
                $_SESSION["dataStatus"]=$result['dataStatusTitle'];
                $_SESSION["createdAt"]=$result['createdAt'];
                $_SESSION["updatedAt"]=$result['updatedAt'];
                $_SESSION["userName"]=$result_username['USER_NAME'];
                
              }
              ?>

              <!-- <form action="peditsection.php" method="POST"> -->
              <form action="peditsection.php" method="POST">


                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionNumber">Section Number</label>
                    
                        <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" disabled value="<?= $_SESSION["sectionNumberNew"]; ?>">

                      
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionTitleMalay">Section Title (Malay)</label>
                    <input type="text" class="form-control" id="sectionTitleMalay" name="sectionTitleMalay" disabled value="<?= $result['sectionTitleMalay']; ?>">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectiontitleEnglish">Section Title (English)</label>
                    <input type="text" class="form-control" id="sectionTitleEnglish" name="sectionTitleEnglish" disabled value="<?= $result['sectionTitleEnglish']; ?>">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionDescription">Description</label><br>
                    <textarea name="sectionDescription" id="myTextarea" cols="150" rows="4">
                    <?php 
                      if($_SESSION["sectionDescription"] != NULL) 
                        { echo $_SESSION["sectionDescription"]; } 
                      else
                      { echo "---"; } ?>
                      <?//= $result['sectionDescription']; ?>
                    </textarea>
                  </div>
                </div>

              <div class="card-body">
                <div class="row paddingBottomForInputBahagianBwh">
                  <div class="form-group col-xs-6 paddingRightForInputBahagianBwh padding-left">
                    <label for="USER_ID">Added By</label>
                    <input type="text" class="form-control userName" id="USER_ID" name="USER_ID" disabled value="<?= $_SESSION["userName"]; ?>">
                  </div>
                   <!-- </div> -->

                <!-- <div class="card-body"> -->
                  <div class="form-group col-xs-6 paddingRightForInputBahagianBwh">
                    <label for="dataStatus">Data Status</label>
                    <input type="text" class="form-control dataStatus" id="dataStatus" name="dataStatus" disabled value="<?= $_SESSION["dataStatus"]; ?>">
                  </div>
                <!-- </div> -->

                <!-- <div class="card-body"> -->
                <div class="form-group col-xs-6 paddingRightForInputBahagianBwh">
                    <label for="createdAt">Created At</label>
                    <input type="text" class="form-control timestamp" id="createdAt" name="createdAt" disabled value="<?= $_SESSION["createdAt"]; ?>">
                  </div>
                <!-- </div> -->

                  <!-- <div class="card-body" style="padding-bottom:1em"> -->
                  <div class="form-group col-xs-6">
                    <label for="updatedAt">Updated At</label>
                    <input type="text" class="form-control timestamp" id="updatedAt" name="updatedAt" disabled value="<?php 
                      if($_SESSION["updatedAt"] != NULL) 
                        { echo $_SESSION["updatedAt"]; } 
                      else
                      { echo "---"; } ?> ">
                      <?php //$_SESSION["updatedAt"]; ?>
                  </div>
                <!-- </div> -->

                </div>
             </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="editsection.php?sectionNumber=<?= $result['token'];?>" class="btn btn-primary">Edit</a>
                  <a href="section.php" class="btn btn-primary">Back to Add Section</a>
                  
                </div>
              </form>
            </div>
            
            
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
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

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
    selector: "#myTextarea",
    readonly: true,
    height: "500"   
});


</script>

</body>
</html>
