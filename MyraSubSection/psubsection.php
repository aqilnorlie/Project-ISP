<?php

include('../MyraLogin/MyraFunctionLogin.php');
include("../MyraLogin/connection.php");
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

$data = $_POST;
$token = generateToken(32);

$sqlCheckExistedSS = "SELECT * FROM myrasubsection
WHERE sectionId = :sectionId
AND (subSectionTitleMalay = :subSectionTitleMalay
OR subSectionTitleEnglish = :subSectionTitleEnglish)";

$data12 = [
    ":sectionId" => $data["sectionNumber"],
    ":subSectionTitleMalay" => $data["subSectionTitleMalay"],
    'subSectionTitleEnglish' => $data['subSectionTitleEnglish']
];

$statement12 = $conn1->prepare($sqlCheckExistedSS);
$statement12->execute($data12);


if (!empty($statement12->fetch())) {
    ?>
    <script>
        window.location.href='subsection.php?warning2';
    </script>
    <?php
    exit(0);
}

//insert new data
$statement = $conn1->prepare(
    'INSERT INTO myrasubsection ( subSectionTitleMalay, subSectionTitleEnglish, subSectionDescription, sectionId, USER_ID, token) VALUES (:subSectionTitleMalay, :subSectionTitleEnglish, :subSectionDescription, :sectionNumber, :USER_ID, :token)'
);
$addsssuccess = $statement->execute([
    
    'subSectionTitleMalay' => $data['subSectionTitleMalay'],
    'subSectionTitleEnglish' => $data['subSectionTitleEnglish'],
    'subSectionDescription' => $data['subSectionDescription'],
    'sectionNumber'=> $data['sectionNumber'],
    'USER_ID' => $_SESSION['userid'],
    'token'=> $token
   
]);

// START: SS HISTORY

$sqlHistory = "INSERT INTO myrasubsectionhistory (subsectionHistoryProcess, USER_ID) VALUES (:subsectionHistoryProcess, :USER_ID)";
$stmtHistory = $conn1->prepare($sqlHistory);
$data = [
    ':subsectionHistoryProcess' => "ADDED",
   
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
    ss.createdAt = s.createdAt";
$stmtSectionId = $conn1->prepare($querySecId);
$stmtSectionId->execute();

// END: SS HISTORY


if($addsssuccess)
{
header('Location: Subsection.php?successaddss');
}
else
{

}
?>