<?php 

include('../MyraSubSection/sconnection.php');
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
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%111
// if($_GET['searchToken'] == null) 
// {
//   header("Location: ../myraerror/myraerror.php");
// }
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%111
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// kalau url token ditukar (token yg takde dlm database)
// if(isset($_GET['id'])            && checkReportToken($dbh, $_SESSION['userid'], $_GET['id']) == false)
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%111
// if(isset($_GET['searchToken']) && checkReportToken($pdo, $_GET['searchToken']) == false) 
// {
//     // $$$$$$$$$$$$$$$  KENA BUAT MODAL YG NI $$$$$$$$$$$$$$$
//     header("Location: searchhome.php?warning");
// } 

// function checkReportToken($pdo, $token)
// {
//     $found = false;
//     $data = [":token" => $token];
//     $sql = "SELECT token FROM myraterm WHERE BINARY token = :token";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($data);
//     $rowCount = $stmt->rowCount();
//     if($rowCount > 0)
//     {
//         $found = true;    
//     }
    
//     return $found;
// }
// ?>
<!-- // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%111
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<?php
              if(isset($_GET['searchToken']))
              {
                $searchToken = $_GET['searchToken'];
                $data = [':searchToken' => $searchToken];

                // $query = "SELECT * FROM myraterm WHERE token=:termId";

                // $query = "SELECT ss.subSectionTitleMalay, ss.subSectionTitleEnglish, t.termTitleMalay, t.termTitleEnglish, t.termDescription, t.createdAt, t.updatedAt, c.USER_NAME, t.token, s.sectionNumber, s.sectionTitleMalay, s.sectionTitleEnglish, d.dataStatusTitle FROM myraterm t
                // JOIN myrasubsection ss ON t.subSectionId = ss.subSectionId
                // JOIN dataStatus d ON d.dataStatusId = t.dataStatusId
                // JOIN classbook_backup_jengka.vw_staff_phg c ON c.USER_ID = t.USER_ID
                // JOIN myrasection s ON s.sectionId = ss.sectionId
                // WHERE t.token=:termIdToken LIMIT 1";

                $sqlsearch = "SELECT s.sectionNumber, s.sectionTitleMalay, s.sectionTitleEnglish, s.sectionDescription, ss.subSectionTitleMalay, ss.subSectionTitleEnglish, ss.subSectionDescription, t.termTitleMalay, t.termTitleEnglish, t.termDescription, t.token 
                FROM 
                    myraterm t 
                JOIN 
                    myrasubsection ss ON t.subSectionId = ss.subSectionId 
                JOIN 
                    myrasection s ON s.sectionId = ss.sectionId 
                WHERE 
                    t.token = :searchToken";

                $statement = $pdo->prepare($sqlsearch);
                $statement->execute($data);

                $result = $statement->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                // $_SESSION["sectionNumberNew"]=$result['sectionNumber'];
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

                    <!-- <div class="card-body">
                      <div class="form-group">
                        <label for="subSectionTitleMalay">Sub-Section Description</label>
                        <input type="text" class="form-control" id="subSectionDescription" name="subSectionDescription" disabled value="<?//= $result["subSectionDescription"]; ?>">
                      </div>
                    </div> -->

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
               
                <div class="card-body">
                    <div class="form-group">
                    <label for="termTitle">Term Title</label>
                    <input type="text" id="termTitle" class="form-control" disabled value="<?= $result["termTitleMalay"] . " / " . $result["termTitleEnglish"]; ?>">
                    </div>
                </div>

                <!-- <div class="card-body">
                  <div class="form-group">
                    <label for="termTitleMalay">Term Title (Malay)</label>
                    <input type="text" class="form-control" id="termTitleMalay" name="termTitleMalay" disabled value="<?//= $result['termTitleMalay']; ?>">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="termTitleEnglish">Term Title (English)</label>
                    <input type="text" class="form-control" id="termTitleEnglish" name="termTitleEnglish" disabled value="<?//= $result['termTitleEnglish']; ?>">
                  </div>
                </div> -->

                <!-- <div class="card-body">
                  <div class="form-group">
                    <label for="sectionHistoryProcess">Edit Process Details</label>
                    <input type="text" class="form-control" id="sectionHistoryProcess" name="sectionHistoryProcess" >
                  </div>
                </div> -->
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
                  <!-- <a href="editterms.php?termIdToken=<?//= $result['token'];?>" class="btn btn-primary">Edit</a> -->
                  <a href="index.php" class="btn btn-primary">Back</a>
                  <!-- <input type="submit" name="submit_update" value="Save Edit" class="btn btn-primary"> -->
                  <!-- <input type="reset" value="Reset" class="btn btn-primary"> -->
                </div>
              </form>

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            

              <!-- form start -->



              <!-- <form action="peditsection.php" method="POST"> -->

            <!-- </div> -->

              <!-- <div class="card-body">
                <div class="row paddingBottomForInputBahagianBwh">
                  <div class="form-group col-xs-6 paddingRightForInputBahagianBwh padding-left">
                    <label for="USER_ID">Added By</label>
                    <input type="text" class="form-control userName" id="USER_ID" name="USER_ID" disabled value="<?//= $result["USER_NAME"]; ?>">
                  </div> -->
                <!-- </div> -->

                <!-- <div class="card-body"> -->
                  <!-- <div class="form-group col-xs-6 paddingRightForInputBahagianBwh">
                    <label for="dataStatus">Data Status</label>
                    <input type="text" class="form-control dataStatus" id="dataStatus" name="dataStatus" disabled value="<?//= $result["dataStatusTitle"]; ?>">
                  </div> -->
                <!-- </div> -->

                <!-- <div class="card-body"> -->
                  <!-- <div class="form-group col-xs-6 paddingRightForInputBahagianBwh">
                    <label for="createdAt">Created At</label>
                    <input type="text" class="form-control timestamp" id="createdAt" name="createdAt" disabled value="<?//= $result["createdAt"]; ?>">
                  </div> -->
                <!-- </div> -->

                <!-- <div class="card-body" style="padding-bottom:1em"> -->
                  <!-- <div class="form-group col-xs-6">
                    <label for="updatedAt">Updated At</label>
                    <input type="text" class="form-control timestamp" id="updatedAt" name="updatedAt" disabled value="<?//php 
                    //   if($result["updatedAt"] != NULL) 
                    //     { echo $result["updatedAt"]; } 
                    //   else
                    //   { echo "---"; } ?> "> -->
                      <?//php //$_SESSION["updatedAt"]; ?>
                  <!-- </div> -->
                <!-- </div> -->
              <!-- </div> -->

             
            
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
            <!-- </div> -->

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

  <!-- Control Sidebar -->
  <!-- <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- Control sidebar content goes here -->
  <!-- </aside> -->
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
    selector: "#myTextarea",
    readonly: true,
    height: "700"   
});

// tinymce.init({
//     selector: '#myTextarea',
//     width: 600,
//     height: 200,
// });
</script>

</body>
</html>