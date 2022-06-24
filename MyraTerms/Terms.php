<?php include('../MyraSubSection/sconnection.php');
session_start();

if(!isset($_SESSION['userislogged']) || $_SESSION['userislogged'] != 1){
  header("Location: ../MyraLogin/login.php");
}


$sql_sectionNumber= "SELECT * from myrasection
ORDER BY sectionNumber";

$sql= "SELECT s.sectionId, s.sectionNumber, ss.subSectionTitleMalay, ss.subSectionId  from myrasubsection ss
join myrasection s on s.sectionId = ss.sectionId
order by s.sectionNumber ";

try
{

  // $statement = $pdo->prepare($query);
  // // $stmt_username = $pdo->prepare($sql_username);
  
  // $statement->execute($data);
  // // $stmt_username->execute();

  // $result = $statement->fetch(PDO::FETCH_ASSOC);

  // $stmt = $pdo->prepare($sql);
  //                 $stmt->execute();
                  

                  
  //                 <?php while($data = $stmt->fetch(PDO::FETCH_ASSOC)) 
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $results=$stmt->fetchAll();

    $stmt_secNum=$pdo->prepare($sql_sectionNumber);
    $stmt_secNum->execute();
    $secNum = $stmt_secNum->fetchAll();
    
}

  catch(Exception $ex)

  {
    echo($ex -> getMessage());
  }

  
  //database connect
 // $host = 'localhost';
// $dbname1 = 'myra';
 // $username = 'root';
// $password = '';

// $dsn = "mysql:host=$host;dbname=$dbname1;";

// $pdo = new PDO($dsn, $username, $password);

          // $d = $pdo->query($sql);               
      ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Term</title>
  
  <link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
            <h1>Term</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../MyraDashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Term</li>
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

            <!-- start search section number -->
            <div class="card-header">
                <h3 class="card-title">[1] Select Section Number</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <!-- <input autocomplete = "false" name ="hidden" type="text" style= "display:none" > -->
                <div class="card-body">
                  <div class="form-group">
                  <form action="Terms.php" method="post"> 
                            <!-- <label for="SearchUserID">Search</label>
                            <input type="search" class="form-control" name="SearchUserID"id="SearchUSerID" placeholder="" required>
                          </div>
                        </div> -->
                        
                          <div class="form-group required">
                            <label for="sectionNumber">Section Number</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <select class="form-control" name="sectionNumber" id="sectionNumber" required>
                                <option value="" disabled selected hidden>SELECT A SECTION FOR THE TERM TO BE INSERTED INTO</option>
                                
                                <?php foreach ($secNum as $output) {?>
                                  <option value="<?php echo $output["sectionId"];
                                    //The value we usually set is the primary key
                                    ?>"><?php echo $output ["sectionNumber"] . " - " . $output["sectionTitleMalay"] . " / " . $output["sectionTitleEnglish"];?></option>
                                  <?php }?>

                              </select>
                              </div>
                            </div>
                          </div>
                        
                            
                          <!-- end search section number -->
                          
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">

                  <button type="submit" name="btnSearchSecNum"class="btn btn-primary">Submit</button>
                  </div>
                  </form>
                  
            </div>

            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                  $data = [":sectionNumber" => $_POST['sectionNumber']];
                  $sql = "SELECT * FROM myrasubsection WHERE sectionId = :sectionNumber";
                  $stmtsecnum = $pdo->prepare($sql);
                  $stmtsecnum->execute($data);
                  $sectionNumberDisabled = $_POST['sectionNumber'];
                  // $rowCount = $stmtsecnum->rowCount();
                  // if($rowCount > 0)
                  // $nameUserAdd = "";

                  $sql_SecNumDisabled="SELECT * FROM myrasection WHERE sectionId = :sectionNumber";
                  $secId = [":sectionNumber" =>  $sectionNumberDisabled];
                  $stmtSecNumDisabled = $pdo->prepare($sql_SecNumDisabled);
                  $stmtSecNumDisabled->execute($secId);
                  $secNumDisabled = $stmtSecNumDisabled->fetch(PDO::FETCH_ASSOC);

                  // $idUserAdd = "";
                  //$results=$stmt->fetchAll();
                  $sectionNumber = $stmtsecnum->fetchAll();
                  // $sectionNumber = $stmtsecnum->fetch(PDO::FETCH_ASSOC);
                  
                  // $nameUserAdd = $d['USER_NAME'];
                  // $idUserAdd = $d['USER_ID'];
                 
                  // $_SESSION['idUserAdd'] = $idUserAdd;
                  // $_SESSION['nameUserAdd'] = $nameUserAdd;
                }?>

            <div style="width:1250px"class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">[2] Add Term Based on Section Number</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="pterms.php" method="POST">

              <div class="card-body">
                  <div class="form-group">
                    <label for="termTitleMalay">Section Number</label>
                    <input type="text" class="form-control" id="sectionNumber" name="sectionNumber" value="<?php if(!isset($secNumDisabled['sectionNumber'])){ echo"---"; }else{echo $secNumDisabled['sectionNumber'] . " - " . $secNumDisabled["sectionTitleMalay"] . " / " . $secNumDisabled["sectionTitleEnglish"];} ?>" disabled>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group required">
                    <label for="subSectionTitleMalay">Sub-Section Title</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <select class="form-control" name="subSectionId" id="subSectionTitleMalay" required>
                        <option value="" disabled selected hidden>SELECT SUB SECTION TITLE</option>
                        <?php foreach ($sectionNumber as $output1) {?>
                          <option value="<?php echo $output1["subSectionId"]; ?>"><?php echo $output1["subSectionTitleMalay"] . " / " . $output1["subSectionTitleEnglish"];?></option>
                            <!-- // The value we usually set is the primary key -->
                          <?php }?>

                      </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group required">
                    <label for="termTitleMalay">Term Title (Malay)</label>
                    <input type="text" class="form-control" id="termTitleMalay" name="termTitleMalay" required>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group required">
                    <label for="termTitleEnglish">Term Title (English)</label>
                    <input type="text" class="form-control" id="termTitleEnglish" name="termTitleEnglish" required>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="termDescription">Term Description</label><br>
                    <textarea name="termDescription" id="myTextarea"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <input class="btn btn-primary" type="reset">
                </div>
              </form>
              </div>
            </div>
            
            <div class="card" style="width:1250px">
              <div class="card-header">
                <h3 class="card-title">All Terms Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table1">
                <table id="example2" class="table table-bordered table-hover table2">
                  <thead>
                  <tr>
                    <th>Section Number</th>
                    <th>Sub-Section Title</th>
                    <th>Term Title (Malay)</th>
                    <th>Term Title (English)</th>
                    <!-- <th>Section Description</th> -->
                    <!-- <th>USER_ID</th> -->
                    <th>Created At</th>
                    <!-- <th>Updated At</th> -->
                    <th>Data Status</th>
                    <th>Action</th>
                    <!-- <th>Date</th> -->
                   
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = "SELECT s.sectionId, s.sectionTitleMalay, s.sectionTitleEnglish, t.termTitleMalay, t.termTitleEnglish, t.createdAt, t.updatedAt, d.dataStatusId, d.dataStatusTitle, t.token, s.sectionNumber, ss.subSectionTitleMalay, ss.subSectionTitleEnglish FROM myra.myraterm t 
                  JOIN myra.datastatus d ON t.dataStatusId = d.dataStatusId 
                  JOIN myra.myrasubsection ss ON ss.subSectionId = t.subSectionId 
                  JOIN myra.myrasection s ON s.sectionId = ss.sectionId 
                  JOIN classbook_backup_jengka.vw_staff_phg c ON c.USER_ID = t.USER_ID";

                  $stmt = $pdo->prepare($sql);
                  $stmt->execute();
                  ?>

                  
                  <?php while($data = $stmt->fetch(PDO::FETCH_ASSOC)) 
                  {
                  ?>
                  
                  <tr>
                    <td><?php echo $data['sectionNumber'] . " - " . $data["sectionTitleMalay"] . " / " . $data["sectionTitleEnglish"];?></td>
                    <td><?php echo $data['subSectionTitleMalay'] . " / " . $data["subSectionTitleEnglish"];?></td>
                    <td class="tmy"><?php echo $data['termTitleMalay'];?></td>
                    <td><?php echo $data['termTitleEnglish'];?></td>
                    <td><?php echo $data['createdAt'];?></td>
                    <td>
                      <?php echo $data['dataStatusTitle'];?>
                    </td> 
                    <td style="text-align: center;">
                    
                    <form action="editterms.php?termIdToken=<?= $data['token']; ?>" method="post" style="margin-block-end: 0.3em;">
                      <!-- <a href="editsection.php"><button type="button" class="f"><i class="fas fa-edit" title="Edit section"></i></button></a> -->
                      <button type="submit" name="edit" class="f"><i class="fas fa-edit" title="Edit section"></i></button>
                    </form>
                      <!-- <a href="viewterms.php"><button type="button" class="f"><i class="fas fa-eye" title="View sub section"></i></button></a> -->
                    <form action="viewterms.php?termIdToken=<?= $data['token']; ?>" method="post" style="margin-block-end: 0.3em;">
                      <button type="submit" name="view" class="f"><i class="fas fa-eye" title="View section"></i></button>
                    </form>
                     <!-- delete button -->
                     <form action="terms.php" id="deleteButton" method="post" style="margin-block-end: 0.3em;" style="margin-block-end: 0.3em;">
                      <button type="submit" data-toggle="modal" data-target="#confirm-edit" class="delete-button delete"><i class="fas fa-trash" title="Delete Terms"></i></button>
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
                    <th>Sub-Section Title</th>
                    <th>Term Title (Malay)</th>
                    <th>Term Title (English)</th>
                    <!-- <th>Section Description</th> -->
                    <!-- <th>USER_ID</th> -->
                    <th>Created At</th>
                    <!-- <th>Updated At</th> -->
                    <th>Data Status</th>
                    <th>Action</th>
                    <!-- <th>Date</th> -->
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

  <!-- START: modal if inserted term already exists -->

  <div class="modal fade" id="modal-warning2">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Already Exist</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Inserted term already exist. Please insert a new term.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- END: modal if inserted term already exists -->

  <!-- START: modal ask to confirm delete data -->
  <div class="modal fade" id="confirmEditData" tabindex="-1" role="dialog" aria-labelledby="confirmEditDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-warning">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                    
                </div>
                <form action="deleteterms.php" method="POST">
                  <div class="modal-body">
                      <input type="hidden" name="tmy" id="delete_id">
                      <p>You are about to delete this term.</p>
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
          <p>The term has been successfully deleted.</p>
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
            <p>Unsuccessful term deletion.</p>
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

      <!-- START: successful add term -->
      <div class="modal fade" id="successaddterm">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Term has been <b>added</b> successfully.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END: successful add section -->

  <!-- START: edit section success -->
  <div class="modal fade" id="successeditterm">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content bg-blue">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Term has been <b>edited</b> successfully.</p>
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

// tinymce.init({
//     selector: '#myTextarea',
//     width: 600,
//     height: 200,
// });
</script>

<script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>

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

<script>
$(document).ready(function () {

    $('.delete-button').click(function (e) {
        e.preventDefault();

        var tmy = $(this).closest('tr').find('.tmy').text();
        // console.log(secNum);
        $('#delete_id').val(tmy);
        $('#confirmEditData').modal('show');

    });
  });
  </script>

  <!-- START: success add term -->
<?php if (isset($_GET['successaddterm'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#successaddterm").modal("show");
    });
    </script>
<?php } ?>
<!-- END: success add tern -->

<!-- START: success edit term -->
<?php if (isset($_GET['successeditterm'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#successeditterm").modal("show");
    });
    </script>
<?php } ?>
<!-- END: success edit term -->

</body>
</html>
