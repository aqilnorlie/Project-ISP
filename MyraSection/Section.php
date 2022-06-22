<?php 

include('sconnection.php'); 
include('../MyraLogin/connection.php');
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
  <title>Section</title>

  <link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />
  <script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>
  <!-- <script src="../Myscript.js"></script> -->

  <!-- amik drpd video YT -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h1>Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../MyraDashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Add Section</li>
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
                <h3 class="card-title">Add Section</h3>
              </div>
              <?php
              function getsectionorderslist($pdo)
              {
                  // default all letters
                  $array_letters = range('A', 'H');

                  // get letters used from database
                  $array_letters_used = array();
                  $index = 0;
                  $sql = "SELECT sectionNumber FROM myra.myrasection ORDER BY sectionNumber ASC";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  while($d = $stmt->fetch(PDO::FETCH_ASSOC))
                  {
                      $array_letters_used[$index] = $d['sectionNumber'];
                      $index++;
                  }

                  // check both arrays
                  $result = array_diff($array_letters, $array_letters_used);

                  // show on screen
                  foreach($result as $key => $val)
                  {       //<option value="    A   ">    A   </option>
                      echo "<option value='".$val."'>".$val."</option>";
                  }
              } ?>

              <!-- /.card-header -->
              <!-- form start -->
              <form action="psection.php" method="POST">
                <div class="card-body">
                  <div class="form-group required">
                    <label for="sectionNumber">Section Number</label>
                    <!--(TEST) <input type="text" class="form-control" id="sectionNumber" placeholder="SELECT ONE" nama="sectionNumber"> -->
                    <div class="input-group"> <!-- amik ni dr roles -->
                      <div class="custom-file">
                        <select class="form-control" name="sectionNumber" id="sectionNumber" required>
                          <option value="" disabled selected hidden>SELECT ONE</option>
                          <?php getsectionorderslist($pdo); //getsectionlist($dbh); ?>
                          <!-- <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                          <option value="F">F</option>
                          <option value="G">G</option>
                          <option value="H">H</option> -->
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group required">
                    <label for="sectionTitleMalay">Section Title (Malay)</label>
                    <input type="text" class="form-control" id="sectionTitleMalay" name="sectionTitleMalay" required>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group required">
                    <label for="sectiontitleEnglish">Section Title (English)</label>
                    <input type="text" class="form-control" id="sectionTitleEnglish" name="sectionTitleEnglish" required>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="sectionDescription">Description</label><br>
                    <textarea name="sectionDescription" id="myTextarea" cols="150" rows="4"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" value="Save" class="btn btn-primary">
                  <input type="reset" value="Reset" class="btn btn-primary">
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
            //$sql = "SELECT * FROM myrasection";
            // $sql = "SELECT * FROM myra.myrasection m 
            // JOIN classbook_backup_jengka.vw_staff_phg c 
            // ON c.USER_ID = m.USER_ID";

            $sql = "SELECT * FROM myra.myrasection m 
            JOIN myra.datastatus d 
            ON m.dataStatusId = d.dataStatusId 
            JOIN classbook_backup_jengka.vw_staff_phg c 
            ON c.USER_ID = m.USER_ID";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            //$username = $conn2->query($sql_username);
            
            ?>
            <!-- end display data table -->

            <div class="card" style="width:1250px">
              <div class="card-header">
                <h3 class="card-title">All Section Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table1">
                <table id="example2" class="table table-bordered table-hover table2">
                  <thead>
                  <tr>
                    <th>Section Number</th>
                    <th>Section Title (Malay)</th>
                    <th>Section Title (English)</th>
                    <!-- <th>Section Description</th> -->
                    <!-- <th>User Name</th> -->
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Data Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                       
                  ?>
                  <tr>
                    
                    <td><?php echo $data['sectionNumber'];?></td>
                    <td><?php echo $data['sectionTitleMalay'];?></td>
                    <td><?php echo $data['sectionTitleEnglish'];?></td>
                    <!-- <td><?php //echo $data['sectionDescription'];?></td> -->
                    <!-- <td><?php //echo $data['USER_NAME'];?></td> -->
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
                      <?php echo $data['dataStatusTitle'];/* 
                      if($data['dataStatusId'] == 1)
                        { echo "Active"; }
                      else
                        { echo "Hidden"; } 
                      */?>
                    </td>
                    <td style="text-align: center;">

                    <!-- edit button -->
                    <form action="editsection.php?sectionNumber=<?= $data['token']; ?>" method="post" style="margin-block-end: 0.3em;">
                      <!-- <a href="editsection.php"><button type="button" class="f"><i class="fas fa-edit" title="Edit section"></i></button></a> -->
                      <button type="submit" name="edit" class="f"><i class="fas fa-edit" title="Edit section"></i></button>
                    </form>

                      <!-- <a href="viewsection.php"><button type="button" class="f"><i class="fas fa-eye" title="View section"></i></button></a> -->
                      
                    <!-- view button -->
                    <form action="viewsection.php?sectionNumber=<?= $data['token']; ?>" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="view" class="f"><i class="fas fa-eye" title="View section"></i></button>
                    </form>

                    <!-- delete button -->
                    <form action="deletesection.php" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" value="<?= $data['token']; ?>" name="delete_section" class="delete"><i class="fas fa-trash" title="Delete section"></i></button>
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
                    <th>Section Title (Malay)</th>
                    <th>Section Title (English)</th>
                    <!-- <th>Section Description</th> -->
                    <!-- <th>User Name</th> -->
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
    <div class="modal-dialog modal-dialog-centered modal-sm">
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

  <div class="modal fade" id="confirm-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-warning">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                    
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete this report.</p>
                    <p>Do you want to proceed?</p>
                    <!--<p class="debug-url"></p>-->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <h4 class="modal-title">Success</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Your report has been successfully deleted.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: bootstrap modal -->


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
    "bJQueryUI":true,
    "bSort":true,
    "bPaginate":true,
    "sPaginationType":"full_numbers",
      "iDisplayLength": 5
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

// tinymce.init({
//     selector: '#myTextarea',
//     width: 600,
//     height: 200,
// });

// init_instance_callback : function(editor) {
//         let editorH = editor.editorContainer.offsetHeight;
//         $('#formTranslation_trad')
//             .css({
//                 'position':'absolute',
//                 'height':editorH
//             })
//             .show();
//     },
</script>

<!-- START try bootstrap modal delete validation (https://youtu.be/mh4MVFiMZTM) ################################################################ -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> -->

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Delete Section Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="deletesection.php" method="POST">

                <div class="modal-body">

                    <input type="hidden"  name="sectionNumber" id="sectionNumber">

                    <h4> Do you want to Delete this Data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                    <button type="submit" name="delete_section" class="btn btn-primary"> Yes </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    $('.deletebtn').on('click', function () {

        $('#deletemodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('sectionNumber').val(data[0]);

    });
});
</script>

<!-- END try bootstrap modal delete validation (https://youtu.be/mh4MVFiMZTM) ################################################################ -->

<!-- START: script for warning modal -->
<?php if (isset($_GET['warning'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning").modal("show");
    });
    </script>
<?php } ?>
<!-- END: script for warning modal -->

<?php if (isset($_GET['delete'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-delete").modal("show");
    });
    </script>
<?php } ?>

<script>
    $('#confirm-edit').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
</script>

</body>
</html>