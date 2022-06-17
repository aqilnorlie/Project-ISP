<?php
include("../MyraLogin/connection.php");


if(isset($_GET['assignId'])){

    $assignId = $_GET['assignId'];
    $data = [':assignId' => $assignId];
  
    $sql = "DELETE FROM myraroleassignment WHERE Token=:assignId";
    $stmt= $conn1->prepare($sql);
    $delete = $stmt->execute($data);

    if($delete){
        header("Location: Administrator.php");

  }

}

?>