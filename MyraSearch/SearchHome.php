<?php 
include('../MyraSubSection/sconnection.php');
session_start();

// $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
// if($pageWasRefreshed ) {
//   $keyword="";
//   unset($_POST["submitsearch"]);
// } 
?>

<!DOCTYPE html>
<html lang="en">
<head>    <!-- Nanti kene betulkan sebab loading interface stuck-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search</title>

  <link rel="stylesheet" href="../mystyle.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href=../plugins/icheck-bootstrap/icheck-bootstrap.min.css> 
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
   
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css"> 

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

<style>
  /* table, td, tr, th, thead, tbody, tfoot {
    border: 2px solid black;
  } */

  .navbar {
    height: 46px;
    width: 100%;
    background-color: #404040;
    /* position:fixed; */
    top: 0;
    z-index: 7;
    padding:0em;
  }

  .navbar a {
      /* float: left; */
      font-size: 16px;
      color: white;
      text-align: center;
      padding: 11px 20px;
      /* margin: 1px 1px; */
      text-decoration: none;
      position: right;
      display: block;
      /* position: fixed; */
      top: 20px;
      right: 30px;
      /* background-color: #0000b3; */
  }

  .navbar a:hover {
    background-color: #555;
  } 

  th {
    text-align: center;
  }
</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <a href="../MyraLogin/login.php">Login</a>
  </div>
  <!-- /.navbar -->

 

  <!-- Content Wrapper. Contains page content -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content">

            <!-- Main content -->
            <section class="content" style= "padding-top: 1px;">
                <div class="container-fluid"><br>
                    <h2 class="text-center display-4">MyRA Search</h2>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form action="searchhome.php" method="POST">
                                <div class="input-group">
                                    <input type="search" id="keyword" name="keyword" class="form-control form-control-lg" placeholder="Type your keywords here">
                                    <div class="input-group-append">
                                        <button id="test" type="submit" name="submitsearch" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <?php
                if(isset($_POST["submitsearch"])){
                  // $count=1;
                  // $count++;
                  $_SESSION['countsearch']++;
                
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                  if($_POST['keyword'] != null)
                  {
                    $keyword = $_POST['keyword'];
                    $newkeyword = str_replace(" ","|",$keyword);

                    $sqlkeyword = "INSERT INTO auditsearch (searchKeyword, searchDateTime) VALUES (:searchKeyword, now())";
                    $stmtkeyword = $pdo->prepare($sqlkeyword);
                    $datakeyword = [
                          ':searchKeyword' => $keyword
                          
                    ];
                    $stmtkeyword->execute($datakeyword);  
                  
                  // echo $_POST['keyword'];
                  
                  // $sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, USER_ID) VALUES (:sectionHistoryProcess, :USER_ID)";
                  // $stmtHistory = $pdo->prepare($sqlHistory);
                  // $data = [
                  //     ':sectionHistoryProcess' => "ADDED",
                  //     // ':sectionId' => $_SESSION['sectionNumber'],
                  //     ':USER_ID' => $_SESSION['userid']
                  //     // ':sectionId' => $sectionid,
                  // ];
                  // $stmtHistory->execute($data);

                  // echo $newkeyword; 
                 
                
                  // echo $test['termTitleMalay'] . "---" . $test['termTitleEnglish'];
                  // }
                  // if($test)
                  // {echo $test["termTitleMalay"];}else{echo "takde";}
                
                
                ?>
             
              <!-- /.card-header -->
              <div class="card-body table1">

                    <table id="example2" class="table table-bordered table-hover table2">

                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Section Number</th>
                        <th>Section Title</th>
                        <th>Sub-section Title</th>
                        <th>Term Title</th>
                        <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>
                        <?php 
                         $sqlsearch = "SELECT s.sectionNumber, s.sectionTitleMalay, s.sectionTitleEnglish, ss.subSectionTitleMalay, ss.subSectionTitleEnglish, t.termTitleMalay, t.termTitleEnglish, t.token 
                         FROM 
                             myraterm t 
                         JOIN 
                             myrasubsection ss ON t.subSectionId = ss.subSectionId 
                         JOIN 
                             myrasection s ON s.sectionId = ss.sectionId 
                         WHERE 
                             t.termTitleMalay REGEXP '$newkeyword' 
                         OR 
                             t.termTitleEnglish REGEXP '$newkeyword'";
       
                           // $stmtsecnum = $pdo->prepare($sql);
                           // $stmtsecnum->execute($data);
       
                         $stmtsearch = $pdo->prepare($sqlsearch);
                         $stmtsearch->execute();
                         
                        $count = 1; ?>
  
                  <?php  
                   while($test = $stmtsearch->fetch(PDO::FETCH_ASSOC))
                  { ?>
                        <tr>
                        <td><?php echo $count++ . "."; ?></td>
                        <td><?php echo $test['sectionNumber']; ?></td>
                        <td><?php echo $test['sectionTitleMalay'] . " / " . $test['sectionTitleEnglish']; ?></td>
                        <td><?php echo $test['subSectionTitleMalay'] . " / " . $test['subSectionTitleEnglish']; ?></td>
                        <td><?php echo $test['termTitleMalay'] . " / " . $test['termTitleEnglish']; ?></td>
                        <td style="text-align:center;vertical-align:middle">
                        <form action="viewsearch.php?searchToken=<?= $test['token']; ?>" method="post">
                          <button type="submit" name="view" class="f"><i class="fas fa-eye" title="View more"></i></button>
                        </form>
                        </td>
                      </tr>
                      <?php } ?>
                      
                      </tbody>

                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Section Number</th>
                        <th>Section Title</th>
                        <th>Sub-section Title</th>
                        <th>Term Title</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>

                    </table>
                  <?php }} ?>
                  </div>
              <!-- /.card-body -->
            </div>

            </section>
    </div>
    <?php } ?>



  <!-- /.content-wrapper -->
  <footer class="main-footer" style= "margin-left:0; position:fixed;bottom:0%;width:100%">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!--<script src="../plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>

<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script> 
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

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

<script>
$(document).ready(function(){
          $("#test").click(function(){
             $(".card-body table1").hide();
        });
 });
<script>

<?php
// if (isset($_POST['aaa'])){
// echo '
// <script type="text/javascript">
// location.reload();
// </script>';
// } ?>

</body>
</html>
