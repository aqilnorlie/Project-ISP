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
  <title>Edit Term</title>

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

if($_GET['termIdToken'] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

// kalau url token ditukar (token yg takde dlm database)
// if(isset($_GET['id'])            && checkReportToken($dbh, $_SESSION['userid'], $_GET['id']) == false)

if(isset($_GET['termIdToken']) && checkReportToken($conn1, $_SESSION['userid'], $_GET['termIdToken']) == false) 
{
    header("Location: terms.php?warning");
} 

function checkReportToken($conn1, $userid, $token)
{
    $found = false;
    $data = [":userid" => $userid, ":token" => $token];
    $sql = "SELECT token FROM myraterm WHERE USER_ID = :userid AND BINARY token = :token";
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
            <h1>Edit Term</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../MyraDashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Term</li>
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
                <h3 class="card-title">Edit Term</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->

              <?php
              if(isset($_GET['termIdToken']))
              {
                $termIdToken = $_GET['termIdToken'];

                $query = "SELECT ss.subSectionTitleMalay, ss.subSectionTitleEnglish, s.sectionNumber, s.sectionTitleMalay, s.sectionTitleEnglish, t.termTitleMalay, t.termTitleEnglish, t.termDescription, t.dataStatusId, t.token FROM myraterm t
                JOIN myrasubsection ss ON ss.subSectionId = t.subSectionId
                JOIN myrasection s ON s.sectionId = ss.sectionId
                WHERE t.token=:termIdToken";
                $statement = $conn1->prepare($query);
                $data = [':termIdToken' => $termIdToken];
                $statement->execute($data);

                $result = $statement->fetch(PDO::FETCH_ASSOC); 
                $_SESSION["termToken"] = $termIdToken;
                $_SESSION["sectionNumberTerm"]=$result['sectionNumber'];
                $_SESSION["subSectionTitleMalayTerm"]=$result['subSectionTitleMalay'];
              }
              ?>

              <form action="peditterms.php" method="POST">


                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionNumber">Section Number</label>
                    <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" value="<?=  $result["sectionNumber"] . " - " . $result["sectionTitleMalay"] . " / " . $result["sectionTitleEnglish"]; ?>" disabled>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group">
                    <label for="subSectionTitleMalay">Sub-Section Title</label>
                    
                        <input type="text" class="form-control" id="subSectionTitleMalay" name="subSectionTitleMalay" disabled value="<?= $result["subSectionTitleMalay"] . " / " . $result["subSectionTitleEnglish"]; ?>">

                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="termTitleMalay">Term Title (Malay)</label>
                    <input type="text" class="form-control" id="termTitleMalay" name="termTitleMalay" value="<?=  $result["termTitleMalay"]; ?>">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="termTitleEnglish">Term Title (English)</label>
                    <input type="text" class="form-control" id="termTitleEnglish" name="termTitleEnglish" value="<?= $result['termTitleEnglish']; ?>">
                  </div>
                </div>
                
                <div class="card-body">
                  <div class="form-group">
                    <label for="termDescription">Description</label><br>
                    <textarea name="termDescription" id="myTextarea" cols="150" rows="4">
                      <?php 
                      if($result['termDescription'] != NULL) 
                      { echo $result['termDescription']; } 
                    else
                    { echo "---"; } ?>
                      </textarea>
                  </div>
                </div>

                <div style="padding-left:30px; padding-top:20px; padding-bottom:20px; font-size:20px;" class="form-check">
                    <input type="hidden" name="dataStatus" value="1" />
                    <input type="checkbox" id="dataStatus" name="dataStatus" value="0" <?php if($result["dataStatusId"] == 0) echo "checked='checked'"; ?> style="width: 15px; height: 15px;">
                    <label class="form-check-label" for="dataStatus" style="padding-left:5px">Check this box to <b>HIDE</b> the data; Uncheck to <b>UNHIDE</b> the data.</label>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="submit_update" value="Save Edit" class="btn btn-primary">
                  <a href="Terms.php" class="btn btn-primary">Back to Add Term</a>
                 
                </div>
              </form>
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
  selector: '#myTextarea',
  plugins: 'lists image save wordcount table',
  toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
  height: "350"
});

</script>

</body>
</html>