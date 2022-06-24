<?php

include('sconnection.php');
include('../MyraLogin/MyraFunctionLogin.php');
session_start();

$data = $_POST;
$_SESSION['sectionNumber'] = $data['sectionNumber'];
$token = generateToken(32);

// validate required fields
// $errors = [];
// foreach (['sectionNumber', 'sectionTitleMalay', 'sectionTitleEnglish', 'sectionDescription'] as $field) {
//     if (empty($data[$field])) {
//         $errors[] = sprintf('The %s is a required field.', $field);
//     }
// }
// if (!empty($errors)) {
//     echo implode('<br />', $errors);
//     exit;
// }

// check existing section number
$statement = $pdo->prepare('SELECT * FROM myra.myrasection WHERE sectionNumber = :sectionNumber');
$statement->execute(['sectionNumber' => $data['sectionNumber']]);

if (!empty($statement->fetch())) { //header('Location: section.php');?>
    <script>
        alert("Inserted section number (Section number <?php echo $data['sectionNumber']; ?>) already exists. Please choose a new section number to be inserted.");
        window.location.href='section.php';
    </script>
    <?php //echo 'Inserted section number already exists.';
    
    exit;
    // header('Location: section.php');
    
}

//insert new data
$statement = $pdo->prepare(
    'INSERT INTO myrasection (sectionNumber, sectionTitleMalay, sectionTitleEnglish, sectionDescription, USER_ID, token) VALUES (:sectionNumber, :sectionTitleMalay, :sectionTitleEnglish, :sectionDescription, :USER_ID, :token)'
);
$addsectionsuccess = $statement->execute([
    'sectionNumber' => $data['sectionNumber'],
    'sectionTitleMalay' => $data['sectionTitleMalay'],
    'sectionTitleEnglish' => $data['sectionTitleEnglish'],
    'sectionDescription' => $data['sectionDescription'],
    'USER_ID' => $_SESSION['userid'],
    'token' => $token
]);

// $secId = $pdo -> lastInsertId();

// START: SECTION HISTORY

$sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, USER_ID) VALUES (:sectionHistoryProcess, :USER_ID)";
$stmtHistory = $pdo->prepare($sqlHistory);
$data = [
    ':sectionHistoryProcess' => "ADDED",
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
    ss.createdAt = s.createdAt";
$stmtSectionId = $pdo->prepare($querySecId);
$stmtSectionId->execute();

// END: SECTION HISTORY

// $sqlSectionId = "SELECT * FROM myrasection WHERE sectionId = :sectionId";

// $dataSectionId = ['sectionId' => $_SESSION['sectionNumber']];
// $stmtSectionId = $pdo->prepare($sqlSectionId);
// $stmtSectionId->execute($dataSectionId);
// $resultSecId = $stmtSectionId->fetch(PDO::FETCH_ASSOC);

// $sqlHistorySecId = "INSERT INTO myrasectionhistory (sectionId) VALUES (:sectionId)";
// $stmtHistorySecId = $pdo->prepare($sqlHistorySecId);
// $dataHistorySecId = [
//     ':sectionId' => $_SESSION['sectionNumber']
//     // ':sectionId' => $dataSectionId['sectionId'],
//     // ':USER_ID' => $_SESSION['userid']
//     // ':sectionId' => $sectionid,
// ];
// $stmtHistorySecId->execute($dataHistorySecId);

//echo 'The new section has been successfully inserted into database.';

if($addsectionsuccess)
{
    header('Location: section.php?successadd');
}
else
{
    
}
?>