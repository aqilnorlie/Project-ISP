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

if(isset($_POST['submit_updatess']))
{
    // $sectionid = $_POST['sectionId'];
    // $sectionId = amik sub section punya token sebenarnya 
    $sectionId = $_SESSION["subSectionToken"];
    // $_POST['sectionNumber'];
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

            $statement = $pdo->prepare($query);

            $data = [
                ':subSectionTitleMalay' => $subSectionTitleMalay,
                ':subSectionTitleEnglish' => $subSectionTitleEnglish,
                ':subSectionDescription' => $subSectionDescription,
                // ':sectionId' => $sectionid,
                ':sectionId' => $sectionId,
                ':dataStatusId' => 0
            ];

            $query_execute = $statement->execute($data);

            if($query_execute)
            {
                // $_SESSION['message'] = "Section HAS been updated.";
                header('Location: Subsection.php');
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

            $statement = $pdo->prepare($query);

            $data = [
                ':subSectionTitleMalay' => $subSectionTitleMalay,
                ':subSectionTitleEnglish' => $subSectionTitleEnglish,
                ':subSectionDescription' => $subSectionDescription,
                // ':sectionId' => $sectionid,
                ':sectionId' => $sectionId,
                ':dataStatusId' => 1
            ];

            $query_execute = $statement->execute($data);

            if($query_execute)
            {
                // $_SESSION['message'] = "Section HAS been updated.";
                header('Location: Subsection.php');
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

    // $query = "UPDATE myrasection
    // SET sectionTitleMalay='$titlemy', 
    // sectionTitleEnglish='$titleeng', 
    // sectionDescription='$desc' 
    // WHERE sectionNumber='$sectionnumber'";

    // // $query_run = mysqli_query($con, $query);

    // $stmt = $pdo->query($query);

    // echo 'Section has been updated.';

?>