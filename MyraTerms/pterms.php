<?php

include('../MyraLogin/MyraFunctionLogin.php');
include("../MyraLogin/connection.php");
session_start();
$data = $_POST;
$token = generateToken(32);

// check existing term
$queryCheck = 'SELECT * FROM myraterm 
WHERE subSectionId = :subSectionId
AND (termTitleMalay = :termTitleMalay
OR termTitleEnglish = :termTitleEnglish)';

$dataCheck = [
    ':subSectionId' => $data['subSectionId'],
    ':termTitleMalay' => $data['termTitleMalay'],
    ':termTitleEnglish' => $data['termTitleEnglish']
];

$statementCheck = $conn1->prepare($queryCheck);
$statementCheck->execute($dataCheck);

if (!empty($statementCheck->fetch())) { 
    // echo 'Inserted section number already exists.'; ?>
    <script>
        // alert("Inserted sub-section number already exists.");
        window.location.href='Terms.php?warning2';
    </script>
    <?php exit;
}

//insert new data

$statement = $conn1->prepare(
    "INSERT INTO myraterm ( termTitleMalay, termTitleEnglish, termDescription, subSectionId, USER_ID, token) VALUES (:termTitleMalay, :termTitleEnglish, :termDescription, :subSectionId, :USER_ID, :token)"
);

$successaddterm = $statement->execute([
    
    
    'termTitleMalay' => $data['termTitleMalay'],
    'termTitleEnglish' => $data['termTitleEnglish'],
    'termDescription' => $data['termDescription'],
    'subSectionId'=> $data['subSectionId'],
    'USER_ID' => $_SESSION['userid'],
    'token'=> $token

    
]);

$sqlHistory = "INSERT INTO myratermhistory (termHistoryProcess, USER_ID) VALUES (:termHistoryProcess, :USER_ID)";
$stmtHistory = $conn1->prepare($sqlHistory);
$data = [
    ':termHistoryProcess' => "ADDED",
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
    ss.createdAt = s.createdAt";
$stmtSectionId = $conn1->prepare($querySecId);
$stmtSectionId->execute();

// echo 'The new section has been successfully inserted into database.';

if($successaddterm)
{
header('Location: Terms.php?successaddterm');
}
else
{

}

?>