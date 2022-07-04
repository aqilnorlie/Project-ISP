<?php

include('../MyraLogin/MyraFunctionLogin.php');
include("../MyraLogin/connection.php");
session_start();

if($_GET[''] == null) 
{
  header("Location: ../myraerror/myraerror.php");
}

$data = $_POST;
$_SESSION['sectionNumber'] = $data['sectionNumber'];
$token = generateToken(32);


// check existing section number
$statement = $conn1->prepare('SELECT * FROM myra.myrasection WHERE sectionNumber = :sectionNumber');
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
$statement = $conn1->prepare(
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


// START: SECTION HISTORY

$sqlHistory = "INSERT INTO myrasectionhistory (sectionHistoryProcess, USER_ID) VALUES (:sectionHistoryProcess, :USER_ID)";
$stmtHistory = $conn1->prepare($sqlHistory);
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
$stmtSectionId = $conn1->prepare($querySecId);
$stmtSectionId->execute();

if($addsectionsuccess)
{
    header('Location: section.php?successadd');
}
else
{
    header('Location: section.php?notsuccessadd');
}
?>