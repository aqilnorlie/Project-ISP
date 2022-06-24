<?php

include('sconnection.php'); 
session_start();

//database connect
// $host = 'localhost';
// $dbname1 = 'myra';
// $username = 'root';
// $password = '';

// $dsn = "mysql:host=$host;dbname=$dbname1;";

// $options = [
//     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES   => false,
// ];

// try {
//     $pdo = new PDO($dsn, $username, $password, $options);
// } catch (\PDOException $e) {
//     throw new \PDOException($e->getMessage(), (int)$e->getCode());
// }

// function checkReportToken($pdo, $userid, $token)
// {
//     $found = false;
//     $data = ["userid" => $userid, "token" => $token];
//     $sql = "SELECT token FROM myrasection WHERE USER_ID = :userid AND BINARY token = :token";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($data);
//     $rowCount = $stmt->rowCount();
//     if($rowCount > 0)
//     {
//         $found = true;    
//     }
    
//     return $found;
// }

// // kalau url token ditukar (token yg takde dlm database)
// if(isset($_POST['submit_update']) && checkReportToken($pdo, $_SESSION['userid'], $_POST['submit_update']==false)) 
// {
//     header("Location: section.php");
// }


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

            $statement = $pdo->prepare($query);

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
            $stmtHistory = $pdo->prepare($sqlHistory);
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
            $stmtSectionId = $pdo->prepare($querySecId);
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

            $statement = $pdo->prepare($query);

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
            $stmtHistory = $pdo->prepare($sqlHistory);
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
            $stmtSectionId = $pdo->prepare($querySecId);
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

    // $query = "UPDATE myrasection
    // SET sectionTitleMalay='$titlemy', 
    // sectionTitleEnglish='$titleeng', 
    // sectionDescription='$desc' 
    // WHERE sectionNumber='$sectionnumber'";

    // // $query_run = mysqli_query($con, $query);

    // $stmt = $pdo->query($query);

    // echo 'Section has been updated.';

?>