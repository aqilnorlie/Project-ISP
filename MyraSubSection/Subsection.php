<?php 

include("../MyraLogin/connection.php"); 

$sql= "SELECT * from myrasection
ORDER BY sectionNumber";
session_start();

if(!isset($_SESSION['userislogged']) || $_SESSION['userislogged'] != 1){
  header("Location: ../MyraLogin/login.php");
}


try
{
    $stmt=$conn1->prepare($sql);
    $stmt->execute();
    $results=$stmt->fetchAll();
}

  catch(Exception $ex)

  {
    echo($ex -> getMessage());
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sub-Section</title>

  <link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />
  <script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=../plugins/fontawesome-free/css/all.min.css>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
>
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  
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
            <h1>Sub-Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../MyraDashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Sub-Section</li>
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
                <h3 class="card-title">Add Sub-Section</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="psubsection.php" method="POST">

                <div class="card-body">
                  <div class="form-group required">
                    <label for="sectionNumber">Section Number</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <select class="form-control" name="sectionNumber" id="sectionNumber" required>
                        <option value="" disabled selected hidden>SELECT SECTION NUMBER</option>
                        <?php foreach ($results as $output) {?>
                          <option value="<?php echo $output["sectionId"];
                            // The value we usually set is the primary key
                            ?>"><?php echo $output ["sectionNumber"] . " - " . $output ["sectionTitleMalay"] . " / " . $output ["sectionTitleEnglish"];?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="card-body">
                  <div class="form-group required">
                    <label for="subSectionTitleMalay">Sub-Section Title (Malay)</label>
                    <input type="text" class="form-control" id="subSectionTitleMalay" name="subSectionTitleMalay" required autocomplete="off">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group required">
                    <label for="subSectiontitleEnglish">Sub-Section Title (English)</label>
                    <input type="text" class="form-control" id="subSectiontitleEnglish" name="subSectionTitleEnglish" required autocomplete="off">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="myTextarea">Description</label><br>
                    <textarea name="subSectionDescription" id="myTextarea"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <input class="btn btn-primary" type="reset">
                </div>
              </form>
            </div>
            
            <div class="card" style="width:1250px">
              <div class="card-header">
                <h3 class="card-title">All Sub-Section Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table1">
                <table id="example2" class="table table-bordered table-hover table2">
                  <thead>
                  <tr>
                    <th>Section Number</th>
                    <th>Sub-Section Title (Malay)</th>
                    <th>Sub-Section Title (English)</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Data Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  <?php
                  
                 $sql = "SELECT t.sectionNumber, t.sectionTitleMalay, t.sectionTitleEnglish, ss.subSectionTitleMalay, ss.subSectionTitleEnglish, ss.createdAt, ss.updatedAt, d.dataStatusId, ss.token, d.dataStatusTitle 
                 FROM myra.myrasubsection ss 
                 JOIN myra.datastatus d ON ss.dataStatusId = d.dataStatusId 
                 JOIN myra.myrasection t ON t.sectionId = ss.sectionId
                 JOIN classbook_backup_jengka.vw_staff_phg c ON c.USER_ID = ss.USER_ID";

                  $stmt = $conn1->prepare($sql);
                  $stmt->execute();
                                         
                  ?>
                  <?php while($data = $stmt->fetch(PDO::FETCH_ASSOC)) 
                  {
                  ?>
                  
                  <tr>
                    <td><?php echo $data['sectionNumber'] . " - " . $data["sectionTitleMalay"] . " / " . $data["sectionTitleEnglish"];?></td>
                    <td class="ssmy"><?php echo $data['subSectionTitleMalay'];?></td>
                    <td><?php echo $data['subSectionTitleEnglish'];?></td>
                    <td><?php echo $data['createdAt'];?></td>
                    <td>
                      <?php 
                      if($data['updatedAt'] != NULL) 
                      { echo $data['updatedAt']; } 
                      else
                      { echo "<b><center>---</center></b>"; }
                      ?>
                    </td>
                    <td>
                      <?php echo $data['dataStatusTitle'];?>
                    </td>
                    <td style="text-align: center;">
                    
                    <form action="editsubsection.php?subSectionIdToken=<?= $data['token']; ?>" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="edit" class="f"><i class="fas fa-edit" title="Edit sub-section"></i></button>
                    </form>
                      
                    <form action="viewsubsection.php?subSectionIdToken=<?= $data['token']; ?>" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="view" class="f"><i class="fas fa-eye" title="View sub-section"></i></button>
                    </form>
                    <!-- delete button -->
                    <form action="subsection.php" id="deleteButton" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" class="delete-button delete" data-toggle="modal" data-target="#confirm-edit"><i class="fas fa-trash" title="Delete sub-section"></i></button>
                    </form>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Section Number</th>
                    <th>Sub-Section Title (Malay)</th>
                    <th>Sub-Section Title (English)</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Data Status</th>
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

<!-- START: bootstrap modal -->

<!-- START: modal if token url diubah (token tak wujuk dlm database) -->
<div class="modal fade" id="modal-warning">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Unauthorized report access!</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: modal if token url diubah (token tak wujuk dlm database) -->

  <!-- START: modal ask to confirm delete data -->
  <div class="modal fade" id="confirmEditData" tabindex="-1" role="dialog" aria-labelledby="confirmEditDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-warning">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                    
                </div>
                <form action="deletesubsection.php" method="POST">
                  <div class="modal-body">
                      <input type="hidden" name="ssmy" id="delete_id">
                      <p>Are you sure you want to delete this sub-section? <br> <b>All available term(s) under this sub-section will also be deleted</b>.</p>
                      <p>Do you want to proceed?</p>
                      <!--<p class="debug-url"></p>-->
                  </div>
                  
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" name="delete_data" class="btn btn-danger">Yes</button>
                      <!-- <a class="btn btn-danger btn-ok" onclick="window.location='deletesection.php'">Yes</a> -->
                  </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: modal ask to confirm delete data -->

    <!-- START: modal success message delete data -->
    <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <h4 class="modal-title">Success</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>The sub-section has been successfully deleted.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
   <!-- END: modal success message delete data -->

  <!-- START: unsuccessful delete modal -->
  <div class="modal fade" id="deletemodal">
      <div class="modal-dialog">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Unsuccessful sub-section deletion.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: unsuccessful delete modal -->

  <!-- START: modal if inserted ss already exists -->

  <div class="modal fade" id="modal-warning2">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Already Exist</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Inserted sub-section already exist. Please insert a new sub-section.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: modal if inserted ss already exists -->

        <!-- START: successful add ss -->
  <div class="modal fade" id="successaddss">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Sub-section has been <b>added</b> successfully.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: successful add ss -->

  <!-- START: edit section success -->
  <div class="modal fade" id="successeditss">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Sub-section has been <b>edited</b> successfully.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: edit section success -->

  <!-- END: bootstrap modal -->

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
      "bJQueryUI":true,
      "bSort":true,
      "bPaginate":true,
      "sPaginationType":"full_numbers",
       "iDisplayLength": 10
    });
  });
</script>

<script>
tinymce.init({
  selector: '#myTextarea',
  plugins: 'lists image save wordcount table',
  // plugins: 'image',
  // menubar: 'file edit view insert format',
  toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
  height: "350"
});


</script>

<!-- START: script for warning modal -->
<?php if (isset($_GET['warning'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning").modal("show");
    });
    </script>
<?php } ?>
<!-- END: script for warning modal -->

<!-- START: warning2 modal -->
<?php if (isset($_GET['warning2'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning2").modal("show");
    });
    </script>
<?php } ?>
<!-- END: warning2 modal -->

<!-- START: script for deleted data modal -->
<?php if (isset($_GET['delete'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-delete").modal("show");
    });
    </script>
<?php } ?>
<!-- END: script for deleted data modal -->

<!-- START: script for unsuccessful delete modal -->
<?php if (isset($_GET['notdelete'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#deletemodal").modal("show");
    });
    </script>
<?php } ?>
<!-- END: script for unsuccessful delete modal -->

<!-- START: success add ss -->
<?php if (isset($_GET['successaddss'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#successaddss").modal("show");
    });
    </script>
<?php } ?>
<!-- END: success add ss -->

<!-- START: success edit section -->
<?php if (isset($_GET['successeditss'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#successeditss").modal("show");
    });
    </script>
<?php } ?>
<!-- END: success edit section -->

<script>
$(document).ready(function () {

    $('.delete-button').click(function (e) {
        e.preventDefault();

        var ssmy = $(this).closest('tr').find('.ssmy').text();
        // console.log(secNum);
        $('#delete_id').val(ssmy);
        $('#confirmEditData').modal('show');

    });
  });
  </script>

</body>
</html>