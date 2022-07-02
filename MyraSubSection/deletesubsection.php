<?php

include("../MyraLogin/connection.php");
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_POST['delete_data']))
{
    $sstitlemy = $_POST['ssmy'];

    try {

        $data = [
            ':sstitlemy' => $sstitlemy
        ];

        // get subSectionId
        $sqlGetSecId = "SELECT subSectionId FROM myrasubsection WHERE subSectionTitleMalay=:sstitlemy";
        $stmtGetSecId = $conn1->prepare($sqlGetSecId);
        $stmtGetSecId->execute($data);
        $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);

        $query = "DELETE FROM myrasubsection WHERE subSectionTitleMalay=:sstitlemy";
        $statement = $conn1->prepare($query);
        $query_execute = $statement->execute($data);

        $sqlHistory = "INSERT INTO myrasubsectionhistory (subSectionHistoryProcess, subSectionId, USER_ID) VALUES (:subSectionHistoryProcess, :subSectionId, :USER_ID)";
        $stmtHistory = $conn1->prepare($sqlHistory);
        $data2 = [
            ':subSectionHistoryProcess' => "DELETED",
            ':subSectionId' => $result['subSectionId'],
            ':USER_ID' => $_SESSION['userid']
            // ':sectionId' => $sectionid,
        ];
        $stmtHistory->execute($data2);

        $dataterm = [':ssid' => $result['subSectionId']];

        // delete all terms under sub-section
        $sqlgettermid = "SELECT termId FROM myraterm WHERE subSectionId=:ssid";
        $stmtgettermid = $conn1->prepare($sqlgettermid);
        $stmtgettermid->execute($dataterm);
        $resultterm = $stmtgettermid->fetch(PDO::FETCH_ASSOC);

        $querydelterm = "DELETE FROM myraterm WHERE subSectionId=:ssid";
        $statementdelterm = $conn1->prepare($querydelterm);
        $statementdelterm->execute($dataterm);

        if($resultterm != null){
            $sqlHistoryterm = "INSERT INTO myratermhistory (termHistoryProcess, termId, USER_ID) VALUES (:termHistoryProcess, :termId, :USER_ID)";
            $stmtHistoryterm = $conn1->prepare($sqlHistoryterm);
            $data2term = [
                ':termHistoryProcess' => "DELETED",
                ':termId' => $resultterm['termId'],
                ':USER_ID' => $_SESSION['userid']
                // ':sectionId' => $sectionid,
            ];
            $stmtHistoryterm->execute($data2term);
        }
        // end: delete all terms

        if($query_execute)
        {
            // $_SESSION['message'] = "Deleted Successfully";
            header('Location: Subsection.php?delete');
            exit(0);
        }
        else
        {
            // $_SESSION['message'] = "Not Deleted";
            header('Location: Subsection.php?notdelete');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>