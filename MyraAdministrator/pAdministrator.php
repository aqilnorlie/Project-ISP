<?php
include("../Myralogin/connection.php");
include("../Myralogin/MyraFunctionLogin.php");

session_start();

/*if(isset($_POST['btnSearchUser'])){

      // check existing section number
      $statement = $conn1->prepare('SELECT * FROM myra.myraroleassignment WHERE USER_ID = :USER_ID');
      $statement->execute(['USER_ID' => $_POST['SearchUserID']]);
  
      if (!empty($statement->fetch())) {
          echo 'Inserted section number already exists.';
          exit;
      }

   
}*/

  // check existing section number
  if(isset( $_POST["btnAddUser"]) ){
  $statement = $conn1->prepare('SELECT * FROM myra.myraroleassignment WHERE USER_ID = :USER_ID');
  $statement->execute(['USER_ID' =>  $_SESSION['idUserAdd'] ]);

  if (!empty($statement->fetch())) {
      echo 'Inserted section number already exists.';
      echo  $_SESSION['idUserAdd'] ;
      exit;
  }else{
    $role = $_POST["RoleStaff"];
    $acess = $_POST["checkAccess"];
    $userID = $_SESSION["idUserAdd"];

    insertNewUSer($conn1,$acess, $role,$userID);
    //echo  $_SESSION['idUserAdd'];
    header("Location: Administrator.php");
  

  }

  
}
  




/*if(isset( $_POST["btnAddUser"]) ){

   


    $role = $_POST["RoleStaff"];
    $acess = $_POST["checkAccess"];
    $userID = $_SESSION["idUserAdd"];

    insertNewUSer($conn1,$acess, $role,$userID);

    header("Location: Administrator.php");
    

  
}else{

    echo "data not saved";

}*/

?>


  