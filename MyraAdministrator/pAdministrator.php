<?php
include("../Myralogin/connection.php");
include("../Myralogin/MyraFunctionLogin.php");

session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

  // check existing user
  if(isset( $_POST["btnAddUser"]) ){
  $statement = $conn1->prepare('SELECT * FROM myra.myraroleassignment WHERE USER_ID = :USER_ID');
  $statement->execute(['USER_ID' =>  $_SESSION['idUserAdd'] ]);

  //validation
  if (!empty($statement->fetch())) 
  {
      echo 'Inserted section number already exists.';
      echo  $_SESSION['idUserAdd'] ;
      exit;
  }
  else
  {
    $role = $_POST["RoleStaff"];
    $acess = $_POST["checkAccess"];
    $userID = $_SESSION["idUserAdd"];

    // insertNewUSer($conn1,$acess, $role,$userID);
    //echo  $_SESSION['idUserAdd'];

  }

}

insertNewUSer($conn1,$acess, $role,$userID);
header("Location: Administrator.php?successadduser");



?>


  