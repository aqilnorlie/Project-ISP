<?php

require_once 'pdoconfig.php';

try{
    $conn1 = new PDO("mysql:host=$host;dbname=$dbname1", $username, $password);
    $conn2 = new PDO("mysql:host=$host;dbname=$dbname2", $username, $password);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


?>