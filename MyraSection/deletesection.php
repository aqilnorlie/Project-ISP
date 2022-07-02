<?php

include("../MyraLogin/connection.php"); 
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_POST['delete_data']))
{
    // echo $_POST['delete_section'];
    $sectionNo = $_POST['secNum'];

    try {

        $data = [
            ':sectionNo' => $sectionNo
        ];
        
        $sqlGetSecId = "SELECT sectionId FROM myrasection WHERE sectionNumber=:sectionNo";
        $stmtGetSecId = $conn1->prepare($sqlGetSecId);
        $stmtGetSecId->execute($data);
        $result = $stmtGetSecId->fetch(PDO::FETCH_ASSOC);
        // echo $result['sectionId'];

        $query = "DELETE FROM myrasection WHERE sectionNumber=:sectionNo";
        $statement = $conn1->prepare($query);
        $query_execute = $statement->execute($data);

        $sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, sectionId, USER_ID) VALUES (:sectionHistoryProcess, :sectionId, :USER_ID)";
        $stmtHistory = $conn1->prepare($sqlHistory);
        $data2 = [
            ':sectionHistoryProcess' => "DELETED",
            ':sectionId' => $result['sectionId'],
            ':USER_ID' => $_SESSION['userid']
            // ':sectionId' => $sectionid,
        ];
        $stmtHistory->execute($data2);

        $data13 = [':sectionId13' => $result['sectionId']];

        // delete all sub-section under a section to be deleted
        // get subSectionId
        $sqlGetSSId = "SELECT subSectionId FROM myrasubsection WHERE sectionId=:sectionId13";
        $stmtGetSSId = $conn1->prepare($sqlGetSSId);
        $stmtGetSSId->execute($data13);
        $resultSS = $stmtGetSSId->fetch(PDO::FETCH_ASSOC);

        $querydelss = "DELETE FROM myrasubsection WHERE sectionId=:sectionId13";
        $statementdelss = $conn1->prepare($querydelss);
        $statementdelss->execute($data13);

        if($resultSS != null){
            $sqlHistoryss = "INSERT INTO myrasubsectionhistory (subSectionHistoryProcess, subSectionId, USER_ID) VALUES (:subSectionHistoryProcess, :subSectionId, :USER_ID)";
            $stmtHistoryss = $conn1->prepare($sqlHistoryss);
            $data2ss = [
                ':subSectionHistoryProcess' => "DELETED",
                ':subSectionId' => $resultSS['subSectionId'],
                ':USER_ID' => $_SESSION['userid']
                // ':sectionId' => $sectionid,
            ];
            $stmtHistoryss->execute($data2ss);
        }

        $dataTerm = [':subSectionId' => $resultSS['subSectionId']];

        // delete all terms under a section to be deleted
        $sqlgettermid = "SELECT termId FROM myraterm WHERE subSectionId=:subSectionId";
        $stmtgettermid = $conn1->prepare($sqlgettermid);
        $stmtgettermid->execute($dataTerm);
        $resultterm = $stmtgettermid->fetch(PDO::FETCH_ASSOC);

        $querydelterm = "DELETE FROM myraterm WHERE subSectionId=:subSectionId";
        $statementdelterm = $conn1->prepare($querydelterm);
        $statementdelterm->execute($dataTerm);

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

       

        if($query_execute)
        {
            // $_SESSION['message'] = "Deleted Successfully";
            header('Location: section.php?delete');
            exit(0);
        }
        else
        {
            // $_SESSION['message'] = "Not Deleted";
            header('Location: section.php?notdelete');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}



?>