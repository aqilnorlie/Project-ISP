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

if(isset($_POST['submit_update']))
{
    // $sectionid = $_POST['sectionId'];
    $sectionNumber = $_SESSION["sectionNumberNew"];
    // $_POST['sectionNumber'];
    $sectionTitleMalay = $_POST['sectionTitleMalay'];
    $sectionTitleEnglish = $_POST['sectionTitleEnglish'];
    $sectionDescription = $_POST['sectionDescription'];
    
    try{
        $query = "UPDATE myrasection 
        SET 
            sectionTitleMalay=:sectionTitleMalay, 
            sectionTitleEnglish=:sectionTitleEnglish, 
            sectionDescription=:sectionDescription 
        WHERE 
            sectionNumber=:sectionNumber LIMIT 1";

        $statement = $pdo->prepare($query);

        $data = [
            ':sectionTitleMalay' => $sectionTitleMalay,
            ':sectionTitleEnglish' => $sectionTitleEnglish,
            ':sectionDescription' => $sectionDescription,
            // ':sectionId' => $sectionid,
            ':sectionNumber' => $sectionNumber
        ];

        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            $_SESSION['message'] = "Section HAS been updated.";
            header('Location: section.php');
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