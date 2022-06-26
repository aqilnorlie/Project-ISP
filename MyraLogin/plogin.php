<?php

/*include("connection.php");
include("function.php");

$userID = mysqli_real_escape_string($conn, $_POST['userid']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM user WHERE USER_ID = '".$userID."' AND USER_PASSWORD = '".$password."'";


$result = mysqli_query($conn, $sql);

$row = mysqli_num_rows($result);

if($row > 0){
    
    $data = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['userLogged'] = 1;
    $_SESSION['userID'] = $data['USER_ID'];
    $_SESSION['userName'] = $data['USER_NAME'];
    $_SESSION['userRole'] = $data['USER_ROLE'];

   
    if($_SESSION['userRole'] == "Administrator"){
        
        header("Location: ../MyraDashboard/index.php");

    }
     else{
        echo "<script language='javascript'>alert('User not allowed yet.');window.location='index.php;</script>";
    }
    
    

}else{
    echo "<script language='javascript'>alert('User not allowed yet.');window.location='login.php;</script>";

}
?> */

//<?php
include("connection.php");
include("MyraFunctionLogin.php");


// if(isset($_POST['btnLog']) && checkCredentials($conn1, $_POST['btnLog']) == false) 
// {
//     header("Location: login.php?warning");
// } 

// function checkCredentials($pdo, $token)
// {
//     $found = false;
//     $data = [":token" => $token];
//     $sql = "SELECT token FROM myraroleassignment WHERE BINARY token = :token";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($data);
//     $rowCount = $stmt->rowCount();
//     if($rowCount > 0)
//     {
//         $found = true;    
//     }
    
//     return $found;
// }
// ?>

<?php
if(isset($_POST['btnLog']))
{
    $userid = trim($_POST['userid']);
    $password = trim($_POST['password']);
    
    // i-staff portal api
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "444",
      CURLOPT_URL => "https://integrasi.uitm.edu.my:444/stars/login/json/".$userid,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n\t\"password\": \"".$password."\"\n}",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: a5f640ca-aedf-6572-f4ef-b6ae06cad9eb",
        "token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiY2xhc3Nib29raW5nIn0._dTe9KRNSHSBMybfC4Gs6Brv6vO2HxQ8CWp9lOtI0hk"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $json = json_decode($response, TRUE);
    
    if($json['status'] == "true")
    {  
        
        if(checkStaffLogin($conn2, $conn1, $userid) == true) //look for this function in MyrafunctionsLogin.php file

            header("Location: ../MyraDashboard/report.php");
        else
           
            header("Location: login.php?warning");
    }
    else if($json['status'] == "false")
    {
        header("Location: login.php?warning");
    }
    // end i-staff portal api
}
?>