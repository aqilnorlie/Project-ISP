<?php 

include("../MyraLogin/connection.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search Result Details</title>

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
              if(isset($_GET['searchToken']))
              {
                $searchToken = $_GET['searchToken'];
                $data = [':searchToken' => $searchToken];


                $sqlsearch = "SELECT s.sectionNumber, s.sectionTitleMalay, s.sectionTitleEnglish, s.sectionDescription, ss.subSectionTitleMalay, ss.subSectionTitleEnglish, ss.subSectionDescription, t.termTitleMalay, t.termTitleEnglish, t.termDescription, t.token 
                FROM 
                    myraterm t 
                JOIN 
                    myrasubsection ss ON t.subSectionId = ss.subSectionId 
                JOIN 
                    myrasection s ON s.sectionId = ss.sectionId 
                WHERE 
                    t.token = :searchToken";

                $statement = $conn1->prepare($sqlsearch);
                $statement->execute($data);

                $result = $statement->fetch(PDO::FETCH_ASSOC); 
              }
              ?>

                  <form style="padding-right:50px;padding-left:50px;padding-top:10px">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="sectionNumber">Section</label>
                        <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" disabled value="<?= $result["sectionNumber"] . " - " . $result["sectionTitleMalay"] . " / " . $result["sectionTitleEnglish"]; ?>">
                      </div>
                    </div>

                    <div class="card-body">
                      <div class="form-group">
                        <label for="subSectionTitle">Sub-Section Title</label>
                        <input type="text" class="form-control" id="subSectionTitle" disabled value="<?= $result["subSectionTitleMalay"] . " / " . $result["subSectionTitleEnglish"]; ?>">
                      </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="subSectionDescription">Sub-Section Description</label><br>
                            <textarea name="subSectionDescription" id="myTextarea" cols="150" rows="4">
                            <?php 
                            if($result['subSectionDescription'] != NULL) 
                            { echo $result['subSectionDescription']; } 
                            else
                            { echo "---"; } ?>
                            </textarea>
                        </div>
                    </div>

               
                <div class="card-body">
                    <div class="form-group">
                    <label for="termTitle">Term Title</label>
                    <input type="text" id="termTitle" class="form-control" disabled value="<?= $result["termTitleMalay"] . " / " . $result["termTitleEnglish"]; ?>">
                    </div>
                </div>

                
                <div class="card-body">
                  <div class="form-group">
                    <label for="termDescription">Term Description</label><br>
                    <textarea name="termDescription" id="myTextarea" cols="150" rows="4">
                      <?php 
                      if($result['termDescription'] != NULL) 
                      { echo $result['termDescription']; } 
                    else
                    { echo "---"; } ?>
                    </textarea>
                  </div>
                </div>

                   <!-- /.card-body -->
                <div class="card-footer" style="background-color:transparent">
                  
                  <a href="../index.php" class="btn btn-primary">Back</a>
              
                </div>
              </form>

    <div class="wrapper">

    <!-- Preloader -->
    <?php include("../MyraPreloader/preloader.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content">
      

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-md-2">

          
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
  <footer class="main-footer" style="margin-left:0;">
    <strong>MYRA Copyright &copy; 2022-2025.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

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
    height: "700"   
});

</script>

</body>
</html>