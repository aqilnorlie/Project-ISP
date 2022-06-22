<?php

include('sconnection.php'); 
session_start();

if(isset($_POST['delete_section']))
{
    // echo $_POST['delete_section'];
    $sectionNo = $_POST['delete_section'];

    try {

        $data = [
            ':sectionNo' => $sectionNo
        ];
        
        $sqlGetSecId = "SELECT sectionId FROM myrasection WHERE token=:sectionNo";
        $stmtGetSecId = $pdo->prepare($sqlGetSecId);
        $stmtGetSecId->execute($data);
        $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);
        // echo $result['sectionId'];

        $query = "DELETE FROM myrasection WHERE token=:sectionNo";
        $statement = $pdo->prepare($query);
        $query_execute = $statement->execute($data);

        $sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, sectionId, USER_ID) VALUES (:sectionHistoryProcess, :sectionId, :USER_ID)";
        $stmtHistory = $pdo->prepare($sqlHistory);
        $data2 = [
            ':sectionHistoryProcess' => "DELETED",
            ':sectionId' => $result['sectionId'],
            ':USER_ID' => $_SESSION['userid']
            // ':sectionId' => $sectionid,
        ];
        $stmtHistory->execute($data2);

        // START: LAST_INSERT_ID() utk amik sectionId FROM myrasection

        // $sqlGetSecId = "SELECT sectionId FROM myrasection WHERE token=:sectionNo";
        // $data = [
        //     ':sectionNo' => $sectionNo
        // ];
        // $stmtGetSecId = $pdo->prepare($sqlGetSecId);
        // $stmtGetSecId->execute($data);
        // $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);

        // // END: LAST_INSERT_ID() utk amik sectionId FROM myrasection

        // $querySecId = 
        // "UPDATE 
        //     myrasectionhistory
        // SET 
        //     sectionId = :sectionId";

        // $dataGetSecId = [':sectionId' => $result];
        // $stmtSectionId = $pdo->prepare($querySecId);
        // $stmtSectionId->execute($dataGetSecId);

        if($query_execute)
        {
            // $_SESSION['message'] = "Deleted Successfully";
            header('Location: section.php');
            exit(0);
        }
        else
        {
            // $_SESSION['message'] = "Not Deleted";
            header('Location: section.php');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>