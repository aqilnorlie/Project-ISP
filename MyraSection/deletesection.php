<?php

include('sconnection.php'); 
session_start();

if(isset($_POST['delete_section']))
{
    $sectionNo = $_POST['delete_section'];

    try {

        $query = "DELETE FROM myrasection WHERE token=:sectionNo";
        $statement = $pdo->prepare($query);
        $data = [
            ':sectionNo' => $sectionNo
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: section.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header('Location: section.php');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>