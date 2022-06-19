<?php

include('../MyraSection/sconnection.php'); 
include('../MyraLogin/MyraFunctionLogin.php');
session_start();
$data = $_POST;
$token = generateToken(32);


// validate required fields
$errors = [];
foreach (['termTitleMalay', 'termTitleEnglish', 'termDescription'] as $field) {
    if (empty($data[$field])) {
        $errors[] = sprintf('The %s is a required field.', $field);
        // echo "123 <br>";
        // header("Location: Terms.php");
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



// echo 'The new section has been successfully inserted into database.';

header('Location: Terms.php');

?>