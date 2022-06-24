<?php
///////start: general functions//////
function nameRoleGreeting($dbh, $userfullname, $roleid)
{
    echo "Hi, " . $userfullname . "<br />" . "Role: " . getRoleTitles($dbh, $roleid);
}



function generateToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $codeAlphabet.= "-_.~";  // Special characters allowed in url
    $max = strlen($codeAlphabet);

    for ($i=0; $i < $length; $i++) 
    {
        $token .= $codeAlphabet[random_int(0, $max-1)]; //random_int() - php7, rand() - php5
    }

    return $token;
}



function checkStaffLogin($dbh, $dbh3, $userid)
{
    $found = false;
    $data = [":userid" => $userid];
    //$sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg a LEFT JOIN attendancerptdb.user_roles b ON a.USER_ID = b.USER_ID WHERE a.USER_ID = :userid";
    $sql = "SELECT * FROM myra.myraroleassignment m JOIN classbook_backup_jengka.vw_staff_phg c ON C.USER_ID = m.USER_ID 
    JOIN myra.myraroles r ON m.roleId = r.roleId JOIN myra.myraaccessstatus s  ON m.statusId = s.statusId WHERE c.USER_ID = :userid and m.statusId = '1'";
    
    
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start(); 
        $_SESSION['userRole'] = $d["roleTitle"];
        $_SESSION['userislogged'] = 1; // 1 - user is successfully logged
        $_SESSION['userid'] = $userid;
        $_SESSION['userfullname'] = $d['USER_NAME'];
       
      
        
        //get role or assign default role
        if(!is_null($d['roleId']))
        {
         
            $roleid = $d['roleId'];
            $_SESSION['roleid'] = $d['roleId'];

            
        }
        
        
        $found = true;
    }
    
    return $found;
}



//Insert New User in database

function insertNewUSer($db, $statusId, $roleId, $UserID){

   $sql =  'INSERT INTO myraroleassignment(statusId, roleId, USER_ID, Token)
    VALUES(:statusId, :roleId, :USER_ID, :Token)';

    $token = generateToken(32);
    $stmt = $db->prepare($sql);
    $stmt->execute(['statusId' => $statusId, 'roleId' => $roleId, 'USER_ID' =>$UserID, 'Token'=> $token]);
    

}


?>