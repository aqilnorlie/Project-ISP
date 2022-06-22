<?php

include('../MyraSection/sconnection.php'); 
include('../MyraLogin/MyraFunctionLogin.php');
session_start();
$data = $_POST;
$token = generateToken(32);


// validate required fields
// $errors = [];
// foreach (['sectionNumber', 'subSectionTitleMalay', 'subSectionTitleEnglish', 'subSectionDescription'] as $field) {
//     if (empty($data[$field])) {
//         $errors[] = sprintf('The %s is a required field.', $field);
//         header("Location: Subsection.php");
//     }
// }
// if (!empty($errors)) {
//     echo implode('<br />', $errors);
//     exit;
// }

// $data = [':subSectionIdToken' => $subSectionIdToken];
//check existing sub section number
// echo $data["sectionId"] . $data["subSectionTitleMalay"];
// exit;
$sqlCheckExistedSS = "SELECT * FROM myrasubsection
WHERE sectionId = :sectionId
AND subSectionTitleMalay = :subSectionTitleMalay
OR subSectionTitleEnglish = :subSectionTitleEnglish";

$data12 = [
    ":sectionId" => $data["sectionNumber"],
    ":subSectionTitleMalay" => $data["subSectionTitleMalay"],
    'subSectionTitleEnglish' => $data['subSectionTitleEnglish']
];

$statement12 = $pdo->prepare($sqlCheckExistedSS);
$statement12->execute($data12);


if (!empty($statement12->fetch())) {
    // echo 'Inserted sub-section already exists.'; ?>
    <script>
        // alert("Inserted sub-section number already exists.");
        window.location.href='subsection.php?warning2';
    </script>
    <?php
    exit(0);
}

//insert new data
$statement = $pdo->prepare(
    'INSERT INTO myrasubsection ( subSectionTitleMalay, subSectionTitleEnglish, subSectionDescription, sectionId, USER_ID, token) VALUES (:subSectionTitleMalay, :subSectionTitleEnglish, :subSectionDescription, :sectionNumber, :USER_ID, :token)'
);
$statement->execute([
    
    'subSectionTitleMalay' => $data['subSectionTitleMalay'],
    'subSectionTitleEnglish' => $data['subSectionTitleEnglish'],
    'subSectionDescription' => $data['subSectionDescription'],
    'sectionNumber'=> $data['sectionNumber'],
    'USER_ID' => $_SESSION['userid'],
    'token'=> $token
    //'USER_ID' => $_SESSION['userid']
]);

// START: SS HISTORY

$sqlHistory = "INSERT INTO myrasubsectionhistory (subsectionHistoryProcess, USER_ID) VALUES (:subsectionHistoryProcess, :USER_ID)";
$stmtHistory = $pdo->prepare($sqlHistory);
$data = [
    ':subsectionHistoryProcess' => "ADDED",
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
    ss.createdAt = s.createdAt";
$stmtSectionId = $pdo->prepare($querySecId);
$stmtSectionId->execute();

// END: SS HISTORY

//echo 'The new section has been successfully inserted into database.';

header('Location: Subsection.php');

?>