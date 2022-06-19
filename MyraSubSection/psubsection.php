<?php

include('../MyraSection/sconnection.php'); 
include('../MyraLogin/MyraFunctionLogin.php');
session_start();
$data = $_POST;
$token = generateToken(32);


// validate required fields
$errors = [];
foreach (['sectionNumber', 'subSectionTitleMalay', 'subSectionTitleEnglish', 'subSectionDescription'] as $field) {
    if (empty($data[$field])) {
        $errors[] = sprintf('The %s is a required field.', $field);
        header("Location: Subsection.php");
    }
}
if (!empty($errors)) {
    echo implode('<br />', $errors);
    exit;
}

// check existing section number
// $statement = $pdo->prepare('SELECT * FROM myra.myrasection WHERE sectionNumber = :sectionNumber');
// $statement->execute(['sectionNumber' => $data['sectionNumber']]);

// if (!empty($statement->fetch())) {
//     echo 'Inserted section number already exists.';
//     exit;
// }

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

//echo 'The new section has been successfully inserted into database.';

header('Location: Subsection.php');

?>
