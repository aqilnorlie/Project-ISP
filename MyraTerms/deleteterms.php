<?php

include('../MyraSection/sconnection.php'); 
session_start();

if(isset($_POST['delete_terms']))
{
    $termToken = $_POST['delete_terms'];
    // echo $termToken;

    try {

        $query = "DELETE FROM myraterm WHERE token=:termToken";
        $statement = $pdo->prepare($query);
        $data = [
            ':termToken' => $termToken
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            // echo $termToken;
            // echo "Deleted Successfully";
            header('Location: Terms.php');
            exit(0);
        }
        else
        {
            echo "Not Deleted";
            header('Location: Terms.php');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>