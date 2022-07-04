<?php

include("../MyraLogin/connection.php");
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

if(isset($_POST['submit_updatess']))
{
   
    // $sectionId = amik sub section punya token sebenarnya 
    $sectionId = $_SESSION["subSectionToken"];
 
    $subSectionTitleMalay = $_POST['subSectionTitleMalay'];
    $subSectionTitleEnglish = $_POST['subSectionTitleEnglish'];
    $subSectionDescription = $_POST['subSectionDescription'];
    
    try{
        if($_POST['dataStatus'] == 0)
        {
            $query = "UPDATE myrasubsection 
            SET 
                subSectionTitleMalay=:subSectionTitleMalay, 
                subSectionTitleEnglish=:subSectionTitleEnglish, 
                subSectionDescription=:subSectionDescription,
                updatedAt=now(),
                dataStatusId=:dataStatusId
            WHERE 
                token=:sectionId LIMIT 1";

            $statement = $conn1->prepare($query);

            $data = [
                ':subSectionTitleMalay' => $subSectionTitleMalay,
                ':subSectionTitleEnglish' => $subSectionTitleEnglish,
                ':subSectionDescription' => $subSectionDescription,
                // ':sectionId' => $sectionid,
                ':sectionId' => $sectionId,
                ':dataStatusId' => 0
            ];

            $query_execute = $statement->execute($data);

            // START: SS HISTORY
            
            $sqlHistory = "INSERT INTO myrasubsectionhistory (subSectionHistoryProcess, USER_ID) VALUES (:subSectionHistoryProcess, :USER_ID)";
            $stmtHistory = $conn1->prepare($sqlHistory);
            $data = [
                ':subSectionHistoryProcess' => "EDITED",
                
                ':USER_ID' => $_SESSION['userid']
               
            ];
            $stmtHistory->execute($data);

            $querySecId = 
            "UPDATE 
                myrasubsectionhistory ss, 
                myrasubsection s
            SET 
                ss.subSectionId = s.subSectionId
            WHERE 
                ss.createdAt = s.updatedAt";
            $stmtSectionId = $conn1->prepare($querySecId);
            $stmtSectionId->execute();

            // END: SS HISTORY

            if($query_execute)
            {
                // $_SESSION['message'] = "Section HAS been updated.";
                header('Location: Subsection.php?successeditss');
                
            }
            else
            {
                // $_SESSION['message'] = "Section has NOT been updated.";
                header('Location: Subsection.php');
                exit(0);
                // echo 'Section has NOT been updated.';
            }
        }

        else if($_POST['dataStatus'] == 1)
        {
            $query = "UPDATE myrasubsection 
            SET 
                subSectionTitleMalay=:subSectionTitleMalay, 
                subSectionTitleEnglish=:subSectionTitleEnglish, 
                subSectionDescription=:subSectionDescription,
                updatedAt=now(),
                dataStatusId=:dataStatusId
            WHERE 
                token=:sectionId LIMIT 1";

            $statement = $conn1->prepare($query);

            $data = [
                ':subSectionTitleMalay' => $subSectionTitleMalay,
                ':subSectionTitleEnglish' => $subSectionTitleEnglish,
                ':subSectionDescription' => $subSectionDescription,
                // ':sectionId' => $sectionid,
                ':sectionId' => $sectionId,
                ':dataStatusId' => 1
            ];

            $query_execute = $statement->execute($data);

            // START: SS HISTORY
            
            $sqlHistory = "INSERT INTO myrasubsectionhistory (subSectionHistoryProcess, USER_ID) VALUES (:subSectionHistoryProcess, :USER_ID)";
            $stmtHistory = $conn1->prepare($sqlHistory);
            $data = [
                ':subSectionHistoryProcess' => "EDITED",
                // ':sectionId' => $_SESSION['sectionNumber'],
                ':USER_ID' => $_SESSION['userid']
                // ':sectionId' => $sectionid,
            ];
            $stmtHistory->execute($data);

            $querySecId = 
            "UPDATE 
                myrasubsectionhistory ss, 
                myrasubsection s
            SET 
                ss.subSectionId = s.subSectionId
            WHERE 
                ss.createdAt = s.updatedAt";
            $stmtSectionId = $conn1->prepare($querySecId);
            $stmtSectionId->execute();

            // END: SS HISTORY

            if($query_execute)
            {
                // $_SESSION['message'] = "Section HAS been updated.";
                header('Location: Subsection.php?successeditss');
                exit(0);
                // echo 'Section HAS been updated.';
            }
            else
            {
                // $_SESSION['message'] = "Section has NOT been updated.";
                header('Location: Subsection.php');
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