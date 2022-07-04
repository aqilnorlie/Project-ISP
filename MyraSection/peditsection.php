<?php

include("../MyraLogin/connection.php");
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_POST['submit_update']))
{
    // $sectionid = $_POST['sectionId'];
    $sectionNumber = $_SESSION["sectionNumberNew"];
    // $_POST['sectionNumber'];
    $sectionTitleMalay = $_POST['sectionTitleMalay'];
    $sectionTitleEnglish = $_POST['sectionTitleEnglish'];
    $sectionDescription = $_POST['sectionDescription'];
    
    try{
        if($_POST['dataStatus'] == 0)
        {
            $query = "UPDATE myrasection 
            SET 
                sectionTitleMalay=:sectionTitleMalay, 
                sectionTitleEnglish=:sectionTitleEnglish, 
                sectionDescription=:sectionDescription,
                updatedAt=now(),
                dataStatusId=:dataStatusId
            WHERE 
                sectionNumber=:sectionNumber LIMIT 1";

            $statement = $conn1->prepare($query);

            $data = [
                ':sectionTitleMalay' => $sectionTitleMalay,
                ':sectionTitleEnglish' => $sectionTitleEnglish,
                ':sectionDescription' => $sectionDescription,
                // ':sectionId' => $sectionid,
                ':sectionNumber' => $sectionNumber,
                ':dataStatusId' => 0
            ];

            $query_execute = $statement->execute($data);

            // START: SECTION HISTORY

            $sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, USER_ID) VALUES (:sectionHistoryProcess, :USER_ID)";
            $stmtHistory = $conn1->prepare($sqlHistory);
            $data = [
                ':sectionHistoryProcess' => "EDITED",
                // ':sectionId' => $_SESSION['sectionNumber'],
                ':USER_ID' => $_SESSION['userid']
                // ':sectionId' => $sectionid,
            ];
            $stmtHistory->execute($data);

            $querySecId = 
            "UPDATE 
                myrasectionhistory ss, 
                myrasection s
            SET 
                ss.sectionId = s.sectionId
            WHERE 
                ss.createdAt = s.updatedAt";
            $stmtSectionId = $conn1->prepare($querySecId);
            $stmtSectionId->execute();

            // END: SECTION HISTORY

            if($query_execute)
            {
                $_SESSION['message'] = "Section HAS been updated.";
                header('Location: section.php?successedit');
                exit(0);
                // echo 'Section HAS been updated.';
            }
            else
            {
                $_SESSION['message'] = "Section has NOT been updated.";
                header('Location: section.php');
                exit(0);
                // echo 'Section has NOT been updated.';
            }
        }

        else if($_POST['dataStatus'] == 1)
        {
            $query = "UPDATE myrasection 
            SET 
                sectionTitleMalay=:sectionTitleMalay, 
                sectionTitleEnglish=:sectionTitleEnglish, 
                sectionDescription=:sectionDescription,
                updatedAt=now(),
                dataStatusId=:dataStatusId
            WHERE 
                sectionNumber=:sectionNumber LIMIT 1";

            $statement = $conn1->prepare($query);

            $data = [
                ':sectionTitleMalay' => $sectionTitleMalay,
                ':sectionTitleEnglish' => $sectionTitleEnglish,
                ':sectionDescription' => $sectionDescription,
                // ':sectionId' => $sectionid,
                ':sectionNumber' => $sectionNumber,
                ':dataStatusId' => 1
            ];

            $query_execute = $statement->execute($data);

            $sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, USER_ID) VALUES (:sectionHistoryProcess, :USER_ID)";
            $stmtHistory = $conn1->prepare($sqlHistory);
            $data = [
                ':sectionHistoryProcess' => "EDITED",
                // ':sectionId' => $_SESSION['sectionNumber'],
                ':USER_ID' => $_SESSION['userid']
                // ':sectionId' => $sectionid,
            ];
            $stmtHistory->execute($data);

            $querySecId = 
            "UPDATE 
                myrasectionhistory ss, 
                myrasection s
            SET 
                ss.sectionId = s.sectionId
            WHERE 
                ss.createdAt = s.updatedAt";
            $stmtSectionId = $conn1->prepare($querySecId);
            $stmtSectionId->execute();

            if($query_execute)
            {
                $_SESSION['message'] = "Section HAS been updated.";
                header('Location: section.php?successedit');
                exit(0);
                // echo 'Section HAS been updated.';
            }
            else
            {
                $_SESSION['message'] = "Section has NOT been updated.";
                header('Location: section.php');
                exit(0);
                // echo 'Section has NOT been updated.';
            }
        }
        
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
}



?>