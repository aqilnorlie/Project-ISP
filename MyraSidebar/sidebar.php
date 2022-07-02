<!DOCTYPE
<html>

<body>
<a href="../MyraDashboard/report.php" class="brand-link" style="background-color: white; ">
      <img src="../dist/img/MyraBG.png" alt="MyRa Logo"  style="opacity: .7; margin-left:15%; max-width:70%; text-align:center;"><br>
      <!-- <span class="brand-text font-weight-light">Myra</span> -->
    </a>
<div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/lecturerjpg.jpg" class="img-circle elevation-2" alt="User Image" style="width:44px; vertical-align:center;">
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
                <a href="../MyraDashboard/report.php" class="nav-link ">
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
                <a href="../MyraDashboard/report.php" class="nav-link ">
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
