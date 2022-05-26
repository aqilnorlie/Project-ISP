

<?php
function checkStaffLogin($dbh, $dbh3, $userid)
{
    $found = false;
    $data = [":userid" => $userid];
    //$sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg a LEFT JOIN attendancerptdb.user_roles b ON a.USER_ID = b.USER_ID WHERE a.USER_ID = :userid";
    $sql = "SELECT * FROM myra.myraroleassignment m 
    JOIN classbook_backup_jengka.vw_staff_phg c 
    ON C.USER_ID = m.USER_ID 
    WHERE c.USER_ID = :userid";
    
    //"SELECT c.USER_ID,c.USER_NAME, m.roleId, m.statusId 
    //FROM myra.myraroleassignment m 
    //JOIN classbook_backup_jengka.vw_staff_phg c 
    //ON C.USER_ID = m.USER_ID;";

    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start(); 
        $_SESSION['userislogged'] = 1; // 1 - user is successfully logged
        $_SESSION['userid'] = $userid;
        $_SESSION['userfullname'] = $d['USER_NAME'];
        
        //get role or assign default role
        if(!is_null($d['roleId']))
        {
            $roleid = $d['roleId'];
            $_SESSION['roleid'] = $d['roleId'];
        }
        else
        {
            $roleid = 55;
            $_SESSION['roleid'] = 55; //default - lecturer
        }
        
        /*$logintoken = generateToken(32);
        $_SESSION['logintoken'] = $logintoken;
        $ipaddress = getIPAddress();
        $logintimestamp = getTimestamp(); */
        
        //get location
        /*$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ipaddress"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
        $region = $geo["geoplugin_region"];
        $loginlocation = "{$country}/{$region}/{$city}";*/
        
        //audit login
        //saveAuditLogin($dbh, $userid, $roleid, $ipaddress, $loginlocation, $logintimestamp, $logintoken);
        
        $found = true;
    }
    
    return $found;
}
?>