<?php

include("../MyraLogin/connection.php");
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_POST['delete_data']))
{
    $tmy = $_POST['tmy'];
    // echo $termToken;

    try {

        $data = [
            ':tmy' => $tmy
        ];

        $sqlGetSecId = "SELECT termId FROM myraterm WHERE termTitleMalay=:tmy";
        $stmtGetSecId = $conn1->prepare($sqlGetSecId);
        $stmtGetSecId->execute($data);
        $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);

        $query = "DELETE FROM myraterm WHERE termTitleMalay=:tmy";
        $statement = $conn1->prepare($query);
        $query_execute = $statement->execute($data);

        $sqlHistory = "INSERT INTO myratermhistory (termHistoryProcess, termId, USER_ID) VALUES (:termHistoryProcess, :termId, :USER_ID)";
        $stmtHistory = $conn1->prepare($sqlHistory);
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
            header('Location: Terms.php?delete');
            exit(0);
        }
        else
        {
            echo "Not Deleted";
            header('Location: Terms.php?notdelete');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>