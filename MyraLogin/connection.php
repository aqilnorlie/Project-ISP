<?php

require_once 'pdoconfig.php';

try{
    $conn1 = new PDO("mysql:host=$host;dbname=$dbname1", $username, $password);
    $conn2 = new PDO("mysql:host=$host;dbname=$dbname2", $username, $password);

    //echo "Connected to the <b>$dbname1</b> database successfully<br />";
    //echo "Connected to the <b>$dbname2</b> database successfully<br />";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


?>