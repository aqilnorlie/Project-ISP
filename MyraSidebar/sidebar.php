<!DOCTYPE
<html>


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

<body>
<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          
          <a href="#" class="d-block"><?php echo  $_SESSION['userfullname']; ?> </a>
          <a href="#" class="d-block"><?php if(isset($_SESSION['userRole'])) {
          echo "Role : ".$_SESSION['userRole'];
          } else {
          echo "No role";
          } ?></a>
        
        </div>
          
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if ($_SESSION['roleid'] == 1) { ?>
          <li class="nav-item menu-open">
              <li class="nav-item">
                <a href="../MyraDashboard/index.php" class="nav-link ">
                  <i class="nav-icon fas fa-home"></i></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </li>
            
          <li class="nav-item menu-open">
           <li class="nav-item">
             <a href="../MyraAdministrator/Administrator.php" class="nav-link">
               <i class="nav-icon fas fa-user-graduate"></i>
               <p>User</p>
             </a>
           </li>
         </li>

          <li class="nav-item">
            <a href="../MyraLogOut/pLogOut.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>

          <?php } ?>
          <?php if ($_SESSION['roleid'] == 2) { ?>

            <li class="nav-item menu-open">
              <li class="nav-item">
                <a href="../MyraDashboard/index.php" class="nav-link ">
                  <i class="nav-icon fas fa-home"></i></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </li>

            <li class="nav-item menu-open">
           <li class="nav-item">
             <a href="../MyraSection/section.php" class="nav-link">
               <i class="nav-icon fas fa-database"></i>
               <p>Section</p>
             </a>
           </li>
         </li>

         <li class="nav-item menu-open">
         <li class="nav-item">
             <a href="../MyraSubsection/subsection.php" class="nav-link">
               <i class="nav-icon fas fa-database"></i>
               <p>Sub Section</p>
             </a>
           </li>
         </li>
         <li class="nav-item menu-open">
         <li class="nav-item">
             <a href="../MyraTerms/Terms.php" class="nav-link ">
               <i class="nav-icon fas fa-database"></i>
               <p>Terms</p>
             </a>
           </li>
         </li>
          <li class="nav-item">
            <a href="../MyraLogOut/pLogOut.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>

          <?php } ?>

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
</body>
</html>
