<?php

include("connection.php");
include("MyraFunctionLogin.php");

 ?>

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