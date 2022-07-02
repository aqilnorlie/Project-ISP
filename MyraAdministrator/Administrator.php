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
  <title>Admin</title>

  <link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />
  <script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

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
              <form action="Administrator.php" method="post" autocomplete = "off"> 
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

              <script>
                  if ( window.history.replaceState ) {
                      window.history.replaceState( null, null, window.location.href );
                    }
                </script> 
             

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
                      window.location.href='administrator.php?warning3';
                    </script>
                  <?php 
                  } 

                    // check existing user
                    
                    $statement = $conn1->prepare('SELECT * FROM myra.myraroleassignment WHERE USER_ID = :USER_ID');
                    $statement->execute(['USER_ID' =>  $d['USER_ID']]);
      
                    //validation
                    if (!empty($statement->fetch())) { 
                      ?>
                        <script>
                            // alert("Inserted sub-section number already exists.");
                            window.location.href='administrator.php?warning2';
                        </script>
                   <?php }
                  
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
                    <td class="staffid"><?php echo $data["USER_ID"]; ?></td>
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

                    <form action="Administrator.php" id="deleteButton" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" data-toggle="modal" data-target="#confirmdeleteuser" class="delete-button delete"><i class="fas fa-trash" title="Delete User"></i></button>
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

  <!-- START: modal if inserted user already exists -->

  <div class="modal fade" id="modal-warning2">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Searched lecturer <b>already exist</b>. Please insert a new Staff ID.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: modal if inserted user already exists -->

  <!-- START: modal if user does not exist -->

    <div class="modal fade" id="modal-warning3">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Searched Staff ID <b>does not exist</b>. Please insert a new Staff ID.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: modal if user does not exist -->

  <!-- START: modal unauthorized access -->

  <div class="modal fade" id="modal-warning4">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p><b>Unauthorized report access!</b></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: modal unauthorized access -->

  <!-- START: successful add user -->
  <div class="modal fade" id="successadduser">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>User has been <b>added</b> successfully.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: successful add user -->

      <!-- START: successful edit user -->
  <div class="modal fade" id="successedituser">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>User has been <b>edited</b> successfully.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: successful edit user -->

      <!-- START: unsuccessful add user -->
  <div class="modal fade" id="failadduser">
      <div class="modal-dialog">
        <div class="modal-content bg-red">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Fail to add user.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: unsuccessful add user -->

  <!-- START: modal ask to confirm delete user -->
  <div class="modal fade" id="confirmdeleteuser" tabindex="-1" role="dialog" aria-labelledby="confirmEditDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-warning">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                    
                </div>
                <form action="administratordelete.php" method="POST">
                  <div class="modal-body">
                      <input type="hidden" name="staffid" id="delete_id">
                      <p>You are about to delete this user.</p>
                      <p>Do you want to proceed?</p>
                  </div>
                  
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" name="delete_data" class="btn btn-danger">Yes</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: modal ask to confirm delete user -->

    <!-- START: modal success message delete user -->
    <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <h4 class="modal-title">Success</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>The user has been successfully deleted.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
   <!-- END: modal success message delete user -->

  <!-- START: unsuccessful delete modal -->
  <div class="modal fade" id="deletemodal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Unsuccessful user deletion.</p>
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
      "iDisplayLength": 10
  });
});
</script>

<!-- START: warning2 modal -->
<?php if (isset($_GET['warning2'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning2").modal("show");
    });
    </script>
<?php } ?>
<!-- END: warning2 modal -->

<!-- START: warning3 modal -->
<?php if (isset($_GET['warning3'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning3").modal("show");
    });
    </script>
<?php } ?>
<!-- END: warning3 modal -->

<!-- START: unauthorized access modal -->
<?php if (isset($_GET['warning4'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning4").modal("show");
    });
    </script>
<?php } ?>
<!-- END: unauthorized access modal -->

<!-- START: success add user -->
<?php if (isset($_GET['successadduser'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#successadduser").modal("show");
    });
    </script>
<?php } ?>
<!-- END: success add user -->

<!-- START: success edit user -->
<?php if (isset($_GET['successedituser'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#successedituser").modal("show");
    });
    </script>
<?php } ?>
<!-- END: success edit user -->

<!-- START: fail add user -->
<?php if (isset($_GET['failadduser'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#failadduser").modal("show");
    });
    </script>
<?php } ?>
<!-- END: fail add user -->

<!-- START: script for deleted user modal -->
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

<script>
$(document).ready(function () {

    $('.delete-button').click(function (e) {
        e.preventDefault();

        var staffid = $(this).closest('tr').find('.staffid').text();
        // console.log(secNum);
        $('#delete_id').val(staffid);
        $('#confirmdeleteuser').modal('show');

    });
  });
  </script>

</body>
</html>
