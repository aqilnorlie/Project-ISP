<?php
include("../MyraLogin/connection.php");


if(isset($_POST['delete_data'])){

  $staffid = $_POST['staffid'];
  $data = [':staffid' => $staffid];

  $sql = "DELETE FROM myraroleassignment WHERE USER_ID=:staffid";
  $stmt= $conn1->prepare($sql);
  $delete = $stmt->execute($data);

  if($delete){
    header("Location: Administrator.php?delete");
  }
  else
  {
    header("Location: Administrator.php?notdelete");
  }

}

?>