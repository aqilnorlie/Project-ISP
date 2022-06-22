<!DOCTYPE html>
<?php
session_start();
include("../connection/connection.php");
include("../settings/settings.php");
include("../functions/functions.php");
if(!isset($_SESSION['userislogged']) || ($_SESSION['userislogged'] != 1))
{
    header("Location: ../index.php");
}
if(!isset($_SESSION['roleid']))
{
    header("Location: ../logout.php");
}
$allowedroles = array("SYSADMIN", "MODERATOR");
if(!in_array($_SESSION['roleid'], $allowedroles))
{
    header("Location: ../logout.php");
}
if(isset($_POST['save']))
{
    $sectionorder = $_POST['sectionorder'];
    $sectiontitlemalay = $_POST['sectiontitlemalay'];
    $sectiontitleenglish = $_POST['sectiontitleenglish'];
    $sectiondescription = $_POST['sectiondescription'];
    
    if(checksectionorderused($dbh, $sectionorder) == true)
        $status = "warning1";    
    else if(checksectiontitle($dbh, $sectiontitlemalay) == true)
        $status = "warning2";
    else
    {
        savesection($dbh, $sectionorder, $sectiontitlemalay, $sectiontitleenglish, $sectiondescription, $_SESSION['userid']);
        $status = "success";
    }
    
    header("Location: addsection.php?".$status);
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php browsertitle(); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
    </ul>

    <!-- SEARCH FORM -->
    <!--<form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">       
      <!-- Notifications Dropdown Menu -> Logout -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user"></i>    
          <span><?php if(isset($_SESSION['userfullname'])) { echo $_SESSION['userfullname']; } ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item dropdown-footer">Log Out</a>
        </div>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <?php smalllogo(); ?>
      <span class="brand-text font-weight-light"><?php systemacronym(); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!--<<div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>-->
        <div class="info">
          <a href="#" class="d-block"><?php if(isset($_SESSION['userfullname']) && isset($_SESSION['roleid'])) { nameRoleGreeting($dbh, $_SESSION['userfullname'], $_SESSION['roleid']); } ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- main links -->
          <?php include("../links/navSideBarLinks.php"); ?>       
          <!-- end main links -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header text-white bg-primary">
                    <h3 class="card-title">Add Section</h3> 
                  </div>                    
                  <form role="form" name="addsection" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="sectionorder">Section Number</label>
                        <select name="sectionorder" class="form-control" id="sectionorder" required>
                            <option value="">SELECT ONE</option>
                            <?php getsectionorderslist($dbh); //getsectionlist($dbh); ?>
                            <!-- function getsectionorderslist($dbh)
                            {
                                // default all letters
                                $array_letters = range('A', 'Z');

                                // get letters used from database
                                $array_letters_used = array();
                                $index = 0;
                                $sql = "SELECT sectionorder FROM myradb.myrasections ORDER BY sectionorder ASC";
                                $stmt = $dbh->prepare($sql);
                                $stmt->execute();
                                while($d = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    $array_letters_used[$index] = $d['sectionorder'];
                                    $index++;
                                }

                                // check both arrays
                                $result = array_diff($array_letters, $array_letters_used);

                                // show on screen
                                foreach($result as $key => $val)
                                {
                                    echo "<option value='".$val."'>".$val."</option>";
                                }
                            } -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="sectiontitlemalay">Section Title (Malay)</label>
                        <input type="text" class="form-control" name="sectiontitlemalay" id="sectiontitlemalay" required>
                      </div>
                      <div class="form-group">
                        <label for="sectiontitleenglish">Section Title (English)</label>
                        <input type="text" class="form-control" name="sectiontitleenglish" id="sectiontitleenglish" required>
                      </div>
                      <div class="form-group">
                        <label for="sectiondescription">Description</label>
                        <textarea id="sectiondescription" name="sectiondescription"></textarea> 
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" name="save" class="btn btn-primary">Save</button>
                      <button type="button" name="cancel" class="btn btn-default" onclick="window.location='listsections.php';">Cancel</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- bootstrap success modal -->
  <div class="modal fade" id="modal-success">
    <div class="modal-dialog">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <h4 class="modal-title">Success</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>New section has been successsfully saved.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.bootstrap success modal -->  
  <!-- bootstrap failed modal -->
  <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Unable to save the selected semester.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.bootstrap failed modal --> 
  <!-- bootstrap warning modal -->
  <div class="modal fade" id="modal-warning1">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Section order has been used. Please select another Section order.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.bootstrap warning modal -->
  <div class="modal fade" id="modal-warning2">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Section title (Malay) already exist or there is an active semester exist.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.bootstrap warning modal -->
  <footer class="main-footer">
    <strong><?php copyright(); ?></strong>
    <div class="float-right d-none d-sm-inline-block"></div>
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
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<?php if (isset($_GET['success'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-success").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['warning1'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning1").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['warning2'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning2").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['failed'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-failed").modal("show");
    });
    </script>
<?php } ?>
<script>
  $(function () {
    // Summernote
    $('#sectiondescription').summernote();
  });
</script>
</body>
</html>
