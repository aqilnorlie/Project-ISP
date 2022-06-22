<?php

include('../MyraSection/sconnection.php'); 
session_start();

if(isset($_POST['delete_terms']))
{
    $termToken = $_POST['delete_terms'];
    // echo $termToken;

    try {

        $data = [
            ':termToken' => $termToken
        ];

        $sqlGetSecId = "SELECT termId FROM myraterm WHERE token=:termToken";
        $stmtGetSecId = $pdo->prepare($sqlGetSecId);
        $stmtGetSecId->execute($data);
        $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);

        $query = "DELETE FROM myraterm WHERE token=:termToken";
        $statement = $pdo->prepare($query);
        $query_execute = $statement->execute($data);

        $sqlHistory = "INSERT INTO myratermhistory (termHistoryProcess, termId, USER_ID) VALUES (:termHistoryProcess, :termId, :USER_ID)";
        $stmtHistory = $pdo->prepare($sqlHistory);
        $data2 = [
            ':termHistoryProcess' => "DELETED",
            ':termId' => $result['termId'],
            ':USER_ID' => $_SESSION['userid']
            // ':sectionId' => $sectionid,
        ];
        $stmtHistory->execute($data2);

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