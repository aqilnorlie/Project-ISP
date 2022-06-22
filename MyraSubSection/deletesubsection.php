<?php

include('sconnection.php'); 
session_start();

if(isset($_POST['delete_section']))
{
    $subSectionIdToken = $_POST['delete_section'];

    try {

        $data = [
            ':subSectionId' => $subSectionIdToken
        ];

        // get subSectionId
        $sqlGetSecId = "SELECT subSectionId FROM myrasubsection WHERE token=:subSectionId";
        $stmtGetSecId = $pdo->prepare($sqlGetSecId);
        $stmtGetSecId->execute($data);
        $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);

        $query = "DELETE FROM myrasubsection WHERE token=:subSectionId";
        $statement = $pdo->prepare($query);
        $query_execute = $statement->execute($data);

        $sqlHistory = "INSERT INTO myrasubsectionhistory (subSectionHistoryProcess, subSectionId, USER_ID) VALUES (:subSectionHistoryProcess, :subSectionId, :USER_ID)";
        $stmtHistory = $pdo->prepare($sqlHistory);
        $data2 = [
            ':subSectionHistoryProcess' => "DELETED",
            ':subSectionId' => $result['subSectionId'],
            ':USER_ID' => $_SESSION['userid']
            // ':sectionId' => $sectionid,
        ];
        $stmtHistory->execute($data2);

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