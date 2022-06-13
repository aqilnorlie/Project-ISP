<?php

include('sconnection.php');

$data = $_POST;

// validate required fields
$errors = [];
foreach (['sectionNumber', 'sectionTitleMalay', 'sectionTitleEnglish', 'sectionDescription'] as $field) {
    if (empty($data[$field])) {
        $errors[] = sprintf('The %s is a required field.', $field);
    }
}
if (!empty($errors)) {
    echo implode('<br />', $errors);
    exit;
}

// check existing section number
$statement = $pdo->prepare('SELECT * FROM myra.myrasection WHERE sectionNumber = :sectionNumber');
$statement->execute(['sectionNumber' => $data['sectionNumber']]);

if (!empty($statement->fetch())) {
    echo 'Inserted section number already exists.';
    exit;
}

//insert new data
$statement = $pdo->prepare(
    'INSERT INTO myrasection (sectionNumber, sectionTitleMalay, sectionTitleEnglish, sectionDescription) VALUES (:sectionNumber, :sectionTitleMalay, :sectionTitleEnglish, :sectionDescription)'
);
$statement->execute([
    'sectionNumber' => $data['sectionNumber'],
    'sectionTitleMalay' => $data['sectionTitleMalay'],
    'sectionTitleEnglish' => $data['sectionTitleEnglish'],
    'sectionDescription' => $data['sectionDescription'],
]);

//echo 'The new section has been successfully inserted into database.';

header('Location: section.php');

?>