<?php

include('../MyraSection/sconnection.php'); 
include('../MyraLogin/MyraFunctionLogin.php');
session_start();
$data = $_POST;
$token = generateToken(32);


// validate required fields
// $errors = [];
// foreach (['termTitleMalay', 'termTitleEnglish', 'termDescription'] as $field) {
//     if (empty($data[$field])) {
//         $errors[] = sprintf('The %s is a required field.', $field);
//         // echo "123 <br>";
//         // header("Location: Terms.php");
//     }
// }
// if (!empty($errors)) {
//     echo implode('<br />', $errors);
//     exit;
// }

// check existing term
$queryCheck = 'SELECT * FROM myraterm 
WHERE subSectionId = :subSectionId
AND termTitleMalay = :termTitleMalay
OR termTitleEnglish = :termTitleEnglish';

$dataCheck = [
    ':subSectionId' => $data['subSectionId'],
    ':termTitleMalay' => $data['termTitleMalay'],
    ':termTitleEnglish' => $data['termTitleEnglish']
];

$statementCheck = $pdo->prepare($queryCheck);
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
// echo "1";
$statement = $pdo->prepare(
    "INSERT INTO myraterm ( termTitleMalay, termTitleEnglish, termDescription, subSectionId, USER_ID, token) VALUES (:termTitleMalay, :termTitleEnglish, :termDescription, :subSectionId, :USER_ID, :token)"
);
// echo "2";
$statement->execute([
    
    
    'termTitleMalay' => $data['termTitleMalay'],
    'termTitleEnglish' => $data['termTitleEnglish'],
    'termDescription' => $data['termDescription'],
    'subSectionId'=> $data['subSectionId'],
    'USER_ID' => $_SESSION['userid'],
    'token'=> $token

    //'USER_ID' => $_SESSION['userid']
]);

$sqlHistory = "INSERT INTO myratermhistory (termHistoryProcess, USER_ID) VALUES (:termHistoryProcess, :USER_ID)";
$stmtHistory = $pdo->prepare($sqlHistory);
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
$stmtSectionId = $pdo->prepare($querySecId);
$stmtSectionId->execute();

// echo 'The new section has been successfully inserted into database.';

header('Location: Terms.php');

?>