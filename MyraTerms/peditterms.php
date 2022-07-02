<?php


include("../MyraLogin/connection.php");
session_start();


if(isset($_POST['submit_update']))
{
   
    $sectionNumberTerm = $_SESSION["sectionNumberTerm"];
    $subSectionTitleMalayTerm = $_SESSION["subSectionTitleMalayTerm"];
    $termToken = $_SESSION["termToken"];


    $termTitleMalay = $_POST['termTitleMalay'];
    $termTitleEnglish = $_POST['termTitleEnglish'];
    $termDescription = $_POST['termDescription'];
    
    try{
        if($_POST['dataStatus'] == 0)
        {
            $query = "UPDATE myraterm
            SET 
                termTitleMalay=:termTitleMalay, 
                termTitleEnglish=:termTitleEnglish, 
                termDescription=:termDescription,
                updatedAt=now(),
                dataStatusId=:dataStatusId
            WHERE 
                token=:token LIMIT 1";

            $statement = $conn1->prepare($query);

            $data = [
                ':termTitleMalay' => $termTitleMalay,
                ':termTitleEnglish' => $termTitleEnglish,
                ':termDescription' => $termDescription,
                ':token' => $termToken,
                ':dataStatusId' => 0
            ];

            $query_execute = $statement->execute($data);

            $sqlHistory = "INSERT INTO myratermhistory (termHistoryProcess, USER_ID) VALUES (:termHistoryProcess, :USER_ID)";
            $stmtHistory = $conn1->prepare($sqlHistory);
            $data = [
                ':termHistoryProcess' => "EDITED",
                ':USER_ID' => $_SESSION['userid']

            ];
            $stmtHistory->execute($data);

            $querySecId = 
            "UPDATE 
                myratermhistory ss, 
                myraterm s
            SET 
                ss.termId = s.termId
            WHERE 
                ss.createdAt = s.updatedAt";
            $stmtSectionId = $conn1->prepare($querySecId);
            $stmtSectionId->execute();

            if($query_execute)
            {
                // $_SESSION['message'] = "Section HAS been updated.";
                header('Location: Terms.php?successeditterm');
                exit(0);
                // echo 'Section HAS been updated.';
            }
            else
            {
                // $_SESSION['message'] = "Section has NOT been updated.";
                header('Location: Terms.php');
                exit(0);
                // echo 'Section has NOT been updated.';
            }
        }

        else if($_POST['dataStatus'] == 1)
        {
            $query = "UPDATE myraterm
            SET 
                termTitleMalay=:termTitleMalay, 
                termTitleEnglish=:termTitleEnglish, 
                termDescription=:termDescription,
                updatedAt=now(),
                dataStatusId=:dataStatusId
            WHERE 
                token=:token LIMIT 1";

            $statement = $conn1->prepare($query);

            $data = [
                ':termTitleMalay' => $termTitleMalay,
                ':termTitleEnglish' => $termTitleEnglish,
                ':termDescription' => $termDescription,
                // ':sectionId' => $sectionid,
                ':token' => $termToken,
                ':dataStatusId' => 1
            ];

            $query_execute = $statement->execute($data);

            $sqlHistory = "INSERT INTO myratermhistory (termHistoryProcess, USER_ID) VALUES (:termHistoryProcess, :USER_ID)";
            $stmtHistory = $conn1->prepare($sqlHistory);
            $data = [
                ':termHistoryProcess' => "EDITED",
                // ':sectionId' => $_SESSION['sectionNumber'],
                ':USER_ID' => $_SESSION['userid']
                // ':sectionId' => $sectionid,
            ];
            $stmtHistory->execute($data);

            $querySecId = 
            "UPDATE 
                myratermhistory ss, 
                myraterm s
            SET 
                ss.termId = s.termId
            WHERE 
                ss.createdAt = s.updatedAt";
            $stmtSectionId = $conn1->prepare($querySecId);
            $stmtSectionId->execute();

            if($query_execute)
            {
                // $_SESSION['message'] = "Section HAS been updated.";
                header('Location: Terms.php?successeditterm');
                exit(0);
                // echo 'Section HAS been updated.';
            }
            else
            {
                // $_SESSION['message'] = "Section has NOT been updated.";
                header('Location: Terms.php');
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