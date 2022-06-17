<?php

include('sconnection.php'); 
session_start();

if(isset($_POST['delete_section']))
{
    $subSectionIdToken = $_POST['delete_section'];

    try {

        $query = "DELETE FROM myrasubsection WHERE token=:subSectionId";
        $statement = $pdo->prepare($query);
        $data = [
            ':subSectionId' => $subSectionIdToken
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            // $_SESSION['message'] = "Deleted Successfully";
            header('Location: Subsection.php');
            exit(0);
        }
        else
        {
            // $_SESSION['message'] = "Not Deleted";
            header('Location: Subsection.php');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>