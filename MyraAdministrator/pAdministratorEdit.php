<?php
include('../MyraLogin/connection.php');
session_start();


if(isset($_POST["btnEditUser"])){

    $status =  $_POST["checkAccess"];
    $roleId = $_POST["RoleStaff"];
    $assignId = $_SESSION['assignIdNew'];

    try{
        $sql = "UPDATE myraroleassignment SET updatedAt = now(),
        statusID = :statusID, roleId = :roleId
        WHERE assignId = :assignId LIMIT 1";
        
        $stmt = $conn1->prepare($sql);

        $data =[
            
            ':statusID' => $status,
            ':roleId' => $roleId,
            ':assignId' => $assignId
        ];

     $query_execute = $stmt->execute($data);

     if($query_execute){
        
        header("Location: Administrator.php");
        exit(0);
     }else{
       
        exit(0);
     }
    }catch(PDOExecption $e){
        echo "Error: " . $e->getMessage();
    }

}







?>