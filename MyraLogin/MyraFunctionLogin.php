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

/*function password_generate($chars) 
{
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    
    return substr(str_shuffle($data), 0, $chars);
}

function changeCaseToUpper($val)
{
    return strtoupper($val);
}

function getTimestamp()
{
    $timestamp = date("Y-m-d H:i:s");

    return $timestamp;
}

*/




/*function getIPAddress()
{
    /*if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;*/
    /*$ipAddress = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
        // to get shared ISP IP address
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } 
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        // check for IPs passing through proxy servers
        // check if multiple IP addresses are set and take the first one
        $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipAddressList as $ip) 
        {
            if (!empty($ip)) 
            {
                // if you prefer, you can check for valid IP address here
                $ipAddress = $ip;
                break;
            }
        }
    } 
    else if (!empty($_SERVER['HTTP_X_FORWARDED'])) 
    {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    } 
    else if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) 
    {
        $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } 
    else if (!empty($_SERVER['HTTP_FORWARDED_FOR'])) 
    {
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } 
    else if (!empty($_SERVER['HTTP_FORWARDED'])) 
    {
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
    } 
    else if (!empty($_SERVER['REMOTE_ADDR'])) 
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    else if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) 
    {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    return $ipAddress;
}

function trimValue($val)
{
    return trim($val);
}

function displayfiletypeicon($filetype)
{
    $icon = "";
    switch($filetype)
    {
        case "image/png":
        case "image/PNG":
        case "image/jpg":
        case "image/JPG":
        case "image/jpeg":
        case "image/JPEG":
            $icon = "far fa-file-image";
            break;
        case "application/pdf":
        case "application/PDF":
            $icon = "far fa-file-pdf";
            break;
        default:
            $icon = "far fa-file";
    }
    
    return $icon;
}

function checkReportToken($dbh, $userid, $token)
{
    $found = false;
    $data = ["userid" => $userid, "token" => $token];
    $sql = "SELECT reporttoken FROM attendancerptdb.reports WHERE USER_ID = :userid AND BINARY reporttoken = :token";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

function checkReportExist($dbh, $token)
{
    $found = false;
    $data = ["token" => $token];
    $sql = "SELECT reporttoken FROM attendancerptdb.reports WHERE BINARY reporttoken = :token";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

function saveAuditLogin($dbh, $userid, $roleid, $ipaddress, $loginlocation, $logintimestamp, $logintoken)
{
    $data = ["userid" => $userid, "roleid" => $roleid, "ip" => $ipaddress, "location" => $loginlocation, "logintimestamp" => $logintimestamp, "token" => $logintoken];
    $sql = "INSERT INTO attendancerptdb.auditlogins (USER_ID, roleid, auditipaddress, auditlocation, auditlogindatetime, auditlogintoken) VALUES (:userid, :roleid, :ip, :location, :logintimestamp, :token)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
}

function saveAuditLogout($dbh, $logintoken, $logouttime)
{
    $updated_at = getTimestamp();
    $data = ["token" => $logintoken, "logouttime" => $logouttime, "updatedat" => $updated_at];
    $sql = "UPDATE attendancerptdb.auditlogins SET auditlogoutdatetime = :logouttime, updated_at = :updatedat WHERE auditlogintoken = :token";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
}


function getfaculties($dbh3)
{
    $sql = "SELECT * FROM classbook_backup_jengka.vw_fakulti_phg";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['JA_KOD_JABATAN']."'>".$d['JABATAN']."</option>";    
        }
    }
}

function getselectedfaculties($dbh3, $facultyid)
{
    $sql = "SELECT * FROM classbook_backup_jengka.vw_fakulti_phg";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if($d['JA_KOD_JABATAN'] == $facultyid)
                echo "<option value='".$d['JA_KOD_JABATAN']."' selected>".$d['JABATAN']."</option>";
            else
                echo "<option value='".$d['JA_KOD_JABATAN']."'>".$d['JABATAN']."</option>";
        }
    }
}

function getFacultiesByRole($dbh3, $facultyid, $roleid)
{
    $allowedroles = array(2, 3);
    $data = ["facultyid" => $facultyid];
    if($roleid == 1 || $roleid == 4) //sys admin, hea
    {
        $sql = "SELECT * FROM classbook_backup_jengka.vw_fakulti_phg";
        $stmt = $dbh3->prepare($sql);
        $stmt->execute();
    }
    else if(in_array($roleid, $allowedroles)) //kpp, koordinator
    {
        $sql = "SELECT * FROM classbook_backup_jengka.vw_fakulti_phg WHERE JA_KOD_JABATAN = :facultyid";
        $stmt = $dbh3->prepare($sql);
        $stmt->execute($data);    
    }
    
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['JA_KOD_JABATAN']."'>".$d['JABATAN']."</option>";    
        }
    }
}

function checkReportsFacultyByRole($dbh, $month, $year, $facultyid)
{
    $found = false;
    $data = ["month" => $month, "year" => $year, "facultyid" => $facultyid];
    $sql = "SELECT u.USER_ID, u.USER_NAME, f.JABATAN, r.reportcourse, c.name_course_eng, r.reportgroup, m.monthtitle, r.reportyear, r.reporttoken
    FROM attendancerptdb.reports r 
    JOIN classbook_backup_jengka.vw_staff_phg u ON r.USER_ID = u.USER_ID 
    JOIN classbook_backup_jengka.vw_fakulti_phg f ON u.JA_KOD_JABATAN = f.JA_KOD_JABATAN 
    JOIN classbook_backup_jengka.vw_active_courses c ON r.reportcourse = c.course_id
    JOIN attendancerptdb.months m ON r.reportmonth = m.monthid
    WHERE r.reportmonth = :month AND r.reportyear = :year AND r.deleted_at IS NULL AND u.USER_DEPTCAMPUS = :facultyid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;
    }
    return $found;
}

function getReportsFacultyByRole($dbh, $month, $year, $facultyid)
{
    $allowedroles = array(2, 3);
    $data = ["month" => $month, "year" => $year, "facultyid" => $facultyid];
    $sql = "SELECT u.USER_ID, u.USER_NAME, f.JABATAN, r.reportcourse, c.name_course_eng, r.reportgroup, m.monthtitle, r.reportyear, r.reporttoken
    FROM attendancerptdb.reports r 
    JOIN classbook_backup_jengka.vw_staff_phg u ON r.USER_ID = u.USER_ID 
    JOIN classbook_backup_jengka.vw_fakulti_phg f ON u.USER_DEPTCAMPUS = f.JA_KOD_JABATAN 
    JOIN classbook_backup_jengka.vw_active_courses c ON r.reportcourse = c.course_id
    JOIN attendancerptdb.months m ON r.reportmonth = m.monthid
    WHERE r.reportmonth = :month AND r.reportyear = :year AND r.deleted_at IS NULL AND u.USER_DEPTCAMPUS = :facultyid 
    ORDER BY 2 ASC, 4 ASC, 6 ASC";

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['JABATAN']."</td>";
                echo "<td>".$d['reportcourse']." - ".$d['name_course_eng']."</td>";
                echo "<td>".$d['reportgroup']."</td>";
                echo "<td>".$d['monthtitle']." ".$d['reportyear']."</td>";
                //echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewreport.php?id=".$d['reporttoken']."\";'><i class='fa fa-eye'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function getFacultyId($dbh3, $userid)
{
    $data = ["userid" => $userid];
    $sql = "SELECT u.JA_KOD_JABATAN FROM classbook_backup_jengka.vw_staff_phg u WHERE u.USER_ID = :userid";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['JA_KOD_JABATAN'];
    }
}

function getFacultyTitle($dbh3, $facultyid)
{
    $data = ["facultyid" => $facultyid];
    $sql = "SELECT f.JABATAN FROM classbook_backup_jengka.vw_fakulti_phg f WHERE f.JA_KOD_JABATAN = :facultyid";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['JABATAN'];
    }
}

function getSemesterActive($dbh3)
{
    $sql = "SELECT SEMESTER_ID FROM classbook_backup_jengka.semester WHERE SEMESTER_ACTIVE = 1";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['SEMESTER_ID'];
    }
}
///////end: general functions//////

/////start: ptft functions/////

function checkPtftStaffNo($dbh, $staffno)
{
    $found = false;
    $data = ["id" => $staffno];
    $sql = "SELECT * FROM dbptftphg.ptfts WHERE PTFT_ID = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

function savePtft($dbh, $userid, $name, $icnum, $faculty, $uitmemail, $altemail, $contactnum, $password, $isactive, $token)
{
    $save = false;
    //$created_at = getTimestamp();
    $data = ["staffno" => $userid, "name" => $name, "icnum" => $icnum, "faculty" => $faculty, "uitmemail" => $uitmemail, "altemail" => $altemail, "contactnum" => $contactnum, "password" => $password, "faculty" => $faculty, "isactive" => $isactive, "token" => $token];
    $sql = "INSERT INTO dbptftphg.ptfts (PTFT_ID, fullname, icnum, password, emailaddressuitm, emailaddressalternate, contactnum, isactive, JA_KOD_JAB, ptfttoken) VALUES (:staffno, :name, :icnum, :password, :uitmemail, :altemail, :contactnum, :isactive, :faculty, :token)";
    $stmt = $dbh->prepare($sql);
    //$stmt->execute($data);
    
    if($stmt->execute($data) == true)
        $save = true;
    
    return $save;
}

function checkResetPassword($dbh, $userid, $email)
{
    $found = false;
    $data = ["ptftid" => $userid, "email" => $email];
    $sql = "SELECT * FROM dbptftphg.ptfts WHERE PTFT_ID = :ptftid AND emailaddressuitm = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

/*function checkPtftLogin($dbh, $dbh3, $userid, $password)
{
    $found = false;
    $data = ["userid" => $userid, "password" => $password];
    $sql = "SELECT * FROM classbook_backup_jengka.user a WHERE a.USER_ID = :userid 
    AND REPLACE(a.USER_ICNO, '-', '') = :password AND a.USER_SIRSACCESS = 1";
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
        //if(!is_null($d['roleid']))
        //{
        //    $roleid = $d['roleid'];
        //    $_SESSION['roleid'] = $d['roleid'];
        //}
        //else
        //{
            $roleid = 56; //55->56
            $_SESSION['roleid'] = 56; //default - ptft
        //}
        
        $logintoken = generateToken(32);
        $_SESSION['logintoken'] = $logintoken;
        $ipaddress = getIPAddress();
        $logintimestamp = getTimestamp();
        
        //get location
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ipaddress"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
        $region = $geo["geoplugin_region"];
        $loginlocation = "{$country}/{$region}/{$city}";
        
        //audit login
        saveAuditLogin($dbh, $userid, $roleid, $ipaddress, $loginlocation, $logintimestamp, $logintoken);
        
        $found = true;
    }
    
    return $found;
} */

/*
function saveauditemail($dbh, $userid, $receiveremail, $status, $type)
{
    $timestamp = getTimestamp();
    $data = ["ptftid" => $userid, "receiver" => $receiveremail, 
            "type" => $type, "status" => $status, "timestamp" => $timestamp];
    $sql = "INSERT INTO attendancerptdb.auditemails (PTFT_ID, receiveremail, sendstatus, type, created_at) VALUES (:ptftid, :receiver, :status, :type, :timestamp)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
}

function saveauditreset($dbh2, $userid, $uitmemail, $status)
{
    $timestamp = getTimestamp();
    $data = ["ptftid" => $userid, "receiver" => $uitmemail, 
            "status" => $status, "timestamp" => $timestamp];
    $sql = "INSERT INTO attendancerptdb.auditresetpassword (PTFT_ID, receiveremail, sendstatus, created_at) VALUES (:ptftid, :receiver, :status, :timestamp)";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
}

function resetPtftPassword($dbh2, $userid, $temppassword)
{
    $status = false;
    $timestamp = getTimestamp();
    $data = ["userid" => $userid, "tmppass" => $temppassword, "timestamp" => $timestamp];
    $sql = "UPDATE dbptftphg.ptfts SET password = :tmppass, updated_at = :timestamp WHERE PTFT_ID = :userid";
    $stmt = $dbh2->prepare($sql);
    
    if($stmt->execute($data))
        $status = true;
    
    return $status;
}

function updatePtftProfile($dbh2, $id, $name, $icnum, $uitmemail, $altemail, $contact)
{
    $status = false;
    $timestamp = getTimestamp();
    $data = ["id" => $id, "name" => $name, "icnum" => $icnum, "uitmemail" => $uitmemail, "altemail" => $altemail, "contact" => $contact, "timestamp" => $timestamp];
    $sql = "UPDATE dbptftphg.ptfts SET fullname = :name, icnum = :icnum, 
            emailaddressuitm = :uitmemail, emailaddressalternate = :altemail, 
            contactnum = :contact, updated_at = :timestamp WHERE PTFT_ID = :id";
    $stmt = $dbh2->prepare($sql);
    
    if($stmt->execute($data))
        $status = true;
    
    return $status;
}

function changePtftPassword($dbh2, $id, $curpassword, $newpassword)
{
    $status = false;
    $timestamp = getTimestamp();
    $curpassword = md5($curpassword);
    $newpassword = md5($newpassword);
    $data = ["id" => $id, "curpassword" => $curpassword, "newpassword" => $newpassword, "timestamp" => $timestamp];
    $sql = "UPDATE dbptftphg.ptfts SET password = :newpassword, updated_at = :timestamp WHERE PTFT_ID = :id AND password = :curpassword";
    $stmt = $dbh2->prepare($sql);
    
    if($stmt->execute($data))
        $status = true;
    
    return $status;
}
/////end: ptft functions/////

/////start: permanent staff/ptft functions/////

*/

function checkStaffLogin($dbh, $dbh3, $userid)
{
    $found = false;
    $data = [":userid" => $userid];
    //$sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg a LEFT JOIN attendancerptdb.user_roles b ON a.USER_ID = b.USER_ID WHERE a.USER_ID = :userid";
    $sql = "SELECT * FROM myra.myraroleassignment m JOIN classbook_backup_jengka.vw_staff_phg c ON C.USER_ID = m.USER_ID 
    JOIN myra.myraroles r ON m.roleId = r.roleId WHERE c.USER_ID = :userid";

    
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start(); 
        $_SESSION['userRole'] = $d["role_Title"];
        $_SESSION['userislogged'] = 1; // 1 - user is successfully logged
        $_SESSION['userid'] = $userid;
        $_SESSION['userfullname'] = $d['USER_NAME'];
       
      
        
        //get role or assign default role
        if(!is_null($d['roleId']))
        {
         
            $roleid = $d['roleId'];
            $_SESSION['roleid'] = $d['roleId'];

            
        }
        /*else
        {
            $roleid = 55;
            $_SESSION['roleid'] = 55; //default - lecturer
        } */
        
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



//Insert New User in database

function insertNewUSer($db, $statusId, $roleId, $UserID){

   $sql =  'INSERT INTO myraroleassignment(statusId, roleId, USER_ID, Token)
    VALUES(:statusId, :roleId, :USER_ID, :Token)';

    $token = generateToken(32);
    $stmt = $db->prepare($sql);
    $stmt->execute(['statusId' => $statusId, 'roleId' => $roleId, 'USER_ID' =>$UserID, 'Token'=> $token]);
    

}


//Display all User






/*function savemyreport($dbh, $semester, $rptrefno, $user_id, $month, $year, $course, $group, $numstudent, $participation, $assessment, $submission, $action, $remarks, $notify, $kppuserid, $students)
{
    $status = false;
    $reporttoken = generateToken(32);
    $data = ["semester" => $semester, "rptrefno" => $rptrefno, "id" => $user_id, "month" => $month, "year" => $year, "course" => $course, "group" => $group, "numstudent" => $numstudent, "participation" => $participation, "assessment" => $assessment, "submission" => $submission, "action" => $action, "remarks" => $remarks, "notify" => $notify, "kpp" => $kppuserid,"students" => $students, "token" => $reporttoken];
    $sql = "INSERT INTO attendancerptdb.reports (reportrefno, SEMESTER_ID, USER_ID, reportmonth, reportyear, reportcourse, reportgroup, reportnumstudent, reportparticipation, reportassessment, reportsubmission, reportaction, reportremarks, reporthea, USER_ID_KPP, reportstudents, reporttoken) VALUES (:rptrefno, :semester, :id, :month, :year, :course, :group, :numstudent, :participation, :assessment, :submission, :action, :remarks, :notify, :kpp, :students, :token)";
    
    $stmt = $dbh->prepare($sql);
    //$stmt->execute($data);
    if($stmt->execute($data))
        $status = true;
    
    return $status;
}*/

/*function updatemyreport($dbh, $rpttoken, $rptrefno, $month, $year, $course, $group, $numstudent, $participation, $assessment, $submission, $action, $remarks, $notify, $kppuserid, $students)
{
    $status = false;
    $timestamp = getTimestamp();
    $data = ["rpttoken" => $rpttoken, "rptrefno" => $rptrefno, "month" => $month, "year" => $year, "course" => $course, "group" => $group, "numstudent" => $numstudent, "participation" => $participation, "assessment" => $assessment, "submission" => $submission, "action" => $action, "remarks" => $remarks, "notify" => $notify, "kpp" => $kppuserid, "students" => $students, "timestamp" => $timestamp];
    $sql = "UPDATE attendancerptdb.reports SET reportmonth = :month, reportyear = :year, reportcourse = :course, reportgroup = :group, reportnumstudent = :numstudent, reportparticipation = :participation, reportassessment = :assessment, reportsubmission = :submission, reportaction = :action, reportremarks = :remarks, reporthea = :notify, USER_ID_KPP = :kpp , reportstudents = :students, updated_at = :timestamp WHERE reporttoken = :rpttoken AND reportrefno = :rptrefno";
    $stmt = $dbh->prepare($sql);
    //$stmt->execute($data);
    if($stmt->execute($data))
        $status = true;
    
    return $status;
}

function deletemyreport($dbh, $rpttoken)
{
    $status = false;
    $timestamp = getTimestamp();
    $data = ["rpttoken" => $rpttoken, "timestamp" => $timestamp];
    $sql = "UPDATE attendancerptdb.reports SET deleted_at = :timestamp WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    
    if($stmt->execute($data))
        $status = true;
    
    return $status;
}

function saveevidence($dbh, $rptrefno, $filename, $filetype, $filesize)
{
    $data = ["rptrefno" => $rptrefno, "evidencefilename" => $filename, "evidencefiletype" => $filetype, "evidencefilesize" => $filesize];
    $sql = "INSERT INTO attendancerptdb.evidences (reportrefno, evidencefilename, evidencefiletype, evidencefilesize) VALUES (:rptrefno, :evidencefilename, :evidencefiletype, :evidencefilesize)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    
    /*if (!$stmt->execute()) {
        print_r($stmt->errorInfo());
    }
}*/
/*
function getmonths($dbh)
{
    $sql = "SELECT * FROM attendancerptdb.months ORDER BY monthid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['monthid']."'>".$d['monthtitle']."</option>";    
        }
    }
}

function getmonthtitle($dbh, $month)
{
    $data = ["month" => $month];
    $sql = "SELECT * FROM attendancerptdb.months WHERE monthid = :month";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['monthtitle'];    
    }
}

function getselectedmonths($dbh, $month)
{
    $sql = "SELECT * FROM attendancerptdb.months ORDER BY monthid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if($d['monthtitle'] == $month)
                echo "<option value='".$d['monthid']."' selected>".$d['monthtitle']."</option>";
            else
                echo "<option value='".$d['monthid']."'>".$d['monthtitle']."</option>";
        }
    }
}

function getListYears()
{
    $currentYear = date("Y");
    $startYear = $currentYear;
    $endYear = $currentYear + 1;
    for($i = $startYear; $i < $endYear; $i++)
        echo "<option value='".$i."'>".$i."</option>";
}

function getSelectedListYears($year)
{
    $currentYear = date("Y");
    $startYear = $currentYear;
    $endYear = $currentYear + 1;
    for($i = $startYear; $i < $endYear; $i++)
    {
        if($i == $year)
            echo "<option value='".$i."' selected>".$i."</option>";
        else
            echo "<option value='".$i."'>".$i."</option>";
    }
}

function getcourses($dbh)
{
    $sql = "SELECT * FROM classbook_backup_jengka.vw_active_courses";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['course_id']."'>".$d['code_course']." - ".$d['name_course_eng']."</option>";    
        }
    }
}

function getselectedcourses($dbh, $courseid)
{
    $sql = "SELECT * FROM classbook_backup_jengka.vw_active_courses";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if($d['course_id'] == $courseid)
            {
                echo "<option value='".$d['course_id']."' selected>".$d['code_course']." - ".$d['name_course_eng']."</option>"; 
            }   
            else
            {
                echo "<option value='".$d['course_id']."'>".$d['code_course']." - ".$d['name_course_eng']."</option>";    
            }
        }
    }
}

function listmyreports($dbh, $userid)
{
    $data = ["id" => $userid];
    $sql = "SELECT * FROM attendancerptdb.reports a JOIN attendancerptdb.months m ON a.reportmonth = m.monthid WHERE a.USER_ID = :id AND a.deleted_at IS NULL ORDER BY a.created_at DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['reportcourse']."</td>";
                echo "<td>".$d['reportgroup']."</td>";
                echo "<td>".$d['monthtitle']." ".$d['reportyear']."</td>";           echo "<td align='center'>";
                    if($d['reporthea'] == 1)
                    {
                        echo "<i class='fas fa-bullhorn'></i>";
                    }
                echo "</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td>".$d['updated_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewmyreport.php?id=".$d['reporttoken']."\";'><i class='fa fa-eye'></i></button> <button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"editmyreport.php?id=".$d['reporttoken']."\";'><i class='fas fa-pencil-alt'></i></button> <button class='btn btn-danger' data-href='listmyreports.php?id=".$d['reporttoken']."' data-toggle='modal' data-target='#confirm-edit'><i class='far fa-trash-alt'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function listallreports($dbh, $facultyid, $roleid)
{
    $allowedroles = array(2, 3);
    $data = ["facultyid" => $facultyid];
    if($roleid == 1 || $roleid == 4) //sys admin, hea
    {
        $sql = "SELECT u.USER_NAME, a.reportcourse, vac.code_course, a.reportgroup, m.monthid, m.monthtitle, a.reportyear, a.reporthea, a.reporttoken, a.created_at 
        FROM classbook_backup_jengka.vw_staff_phg u        
        JOIN attendancerptdb.reports a ON u.USER_ID = a.USER_ID 
        JOIN classbook_backup_jengka.vw_active_courses vac ON vac.course_id = a.reportcourse
        JOIN months m ON a.reportmonth = m.monthid 
        WHERE a.deleted_at IS NULL
        ORDER BY a.created_at DESC";   
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    }
    else if(in_array($roleid, $allowedroles)) //kpp, koordinator
    {
        $sql = "SELECT u.USER_NAME, a.reportcourse, vac.code_course, a.reportgroup, m.monthid, m.monthtitle, a.reportyear, a.reporthea, a.reporttoken, a.created_at 
        FROM classbook_backup_jengka.vw_staff_phg u        
        JOIN attendancerptdb.reports a ON u.USER_ID = a.USER_ID 
        JOIN classbook_backup_jengka.vw_active_courses vac ON vac.course_id = a.reportcourse
        JOIN months m ON a.reportmonth = m.monthid 
        WHERE u.USER_DEPTCAMPUS = :facultyid AND a.deleted_at IS NULL
        ORDER BY a.created_at DESC";  

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }    
    
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['code_course']."</td>";
                echo "<td>".$d['reportgroup']."</td>";
                echo "<td>".$d['monthtitle']." ".$d['reportyear']."</td>";
                echo "<td align='center'>";
                    if($d['reporthea'] == 1)
                    {
                        echo "<i class='fas fa-bullhorn'></i>";
                    }
                echo "</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewreport.php?id=".$d['reporttoken']."\";'><i class='fa fa-eye'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function listactionreports($dbh, $facultyid, $kppuserid, $roleid)
{
    $allowedroles = array(2, 3);
    $data = ["facultyid" => $facultyid, "kppuserid" => $kppuserid];
    if($roleid == 1 || $roleid == 4) //sys admin, hea
    {
        $sql = "SELECT u.USER_NAME, a.reportrefno, a.reportcourse, vac.code_course, a.reportgroup, m.monthid, m.monthtitle, a.reportyear, a.reporthea, a.reporttoken, a.created_at 
        FROM classbook_backup_jengka.vw_staff_phg u 
        JOIN attendancerptdb.reports a ON u.USER_ID = a.USER_ID
        JOIN classbook_backup_jengka.vw_active_courses vac ON vac.course_id = a.reportcourse
        JOIN months m ON a.reportmonth = m.monthid 
        WHERE a.reporthea = 1 AND a.deleted_at IS NULL
        ORDER BY a.created_at DESC";   
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    }
    else if(in_array($roleid, $allowedroles)) //kpp, koordinator
    {
        $sql = "SELECT u.USER_NAME, a.reportrefno, a.reportcourse, vac.code_course, a.reportgroup, m.monthid, m.monthtitle, a.reportyear, a.reporthea, a.reporttoken, a.created_at 
        FROM classbook_backup_jengka.vw_staff_phg u 
        JOIN attendancerptdb.reports a ON u.USER_ID = a.USER_ID
        JOIN classbook_backup_jengka.vw_active_courses vac ON vac.course_id = a.reportcourse
        JOIN months m ON a.reportmonth = m.monthid 
        WHERE (u.USER_DEPTCAMPUS = :facultyid OR a.USER_ID_KPP = :kppuserid) AND a.reporthea = 1 AND a.deleted_at IS NULL
        ORDER BY a.created_at DESC";  
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }     
    
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['reportrefno']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['code_course']."</td>";
                echo "<td>".$d['reportgroup']."</td>";
                echo "<td>".$d['monthtitle']." ".$d['reportyear']."</td>";
                echo "<td align='center'>";
                    if($d['reporthea'] == 1)
                    {
                        echo "<i class='fas fa-bullhorn'></i>";
                    }
                echo "</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewreport.php?id=".$d['reporttoken']."\";'><i class='fa fa-eye'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}


function getReportRefNo($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT r.reportrefno FROM attendancerptdb.reports r WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportrefno'];
    }
}

function getReportSemester($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT r.SEMESTER_ID FROM attendancerptdb.reports r WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['SEMESTER_ID'];
    }
}

function getReportMonth($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT m.monthtitle FROM attendancerptdb.reports r JOIN attendancerptdb.months m ON r.reportmonth = m.monthid WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['monthtitle'];
    }
}

function getReportYear($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT r.reportyear FROM attendancerptdb.reports r WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportyear'];
    }
}

function getReportLecturer($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT u.USER_NAME FROM attendancerptdb.reports r JOIN classbook_backup_jengka.vw_staff_phg u ON r.USER_ID = u.USER_ID WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_NAME'];
    }
}

function getReportCourse($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT r.reportcourse, c.name_course_eng FROM attendancerptdb.reports r JOIN classbook_backup_jengka.vw_active_courses c ON r.reportcourse = c.course_id WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportcourse'] . " - " . $d['name_course_eng'];
    }
}

function getReportCourseId($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT r.reportcourse FROM attendancerptdb.reports r JOIN classbook_backup_jengka.vw_active_courses c ON r.reportcourse = c.course_id WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportcourse'];
    }
}


function getReportGroup($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportgroup FROM attendancerptdb.reports WHERE reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportgroup'];
    }
}

function getReportNumStudent($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportnumstudent FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportnumstudent'];
    }
}


function getReportParticipation($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportparticipation FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportparticipation'];
    }
}

function getReportAssessment($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportassessment FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportassessment'];
    }
}

function getReportSubmission($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportsubmission FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportsubmission'];
    }
}

function getReportAction($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportaction FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportaction'];
    }
}

function getReportRemarks($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportremarks FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportremarks'];
    }
}

function getReportNotify($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reporthea FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reporthea'];
    }
}

function getReportStudents($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT reportstudents FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['reportstudents'];
    }
}

function getequationevidencelist($dbh, $rpttoken)
{
    $data = ["reporttoken" => $rpttoken]; 
    $sql = "SELECT * FROM reports e JOIN evidences ee ON e.reportrefno = ee.reportrefno WHERE BINARY e.reporttoken = :reporttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        $dir = "../evidences/";
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['evidencefilename']."</td>";
                echo "<td><i class='".displayfiletypeicon($d['evidencefiletype'])."'></i> ".$d['evidencefiletype']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick=\"window.open('".$dir.$d['evidencefilename']."', '_blank');\"><i class='fa fa-eye'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function getequationevidencelistedit($dbh, $rpttoken)
{
    $data = ["reporttoken" => $rpttoken]; 
    $sql = "SELECT * FROM reports e JOIN evidences ee ON e.reportrefno = ee.reportrefno WHERE BINARY e.reporttoken = :reporttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        $dir = "../evidences/";
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['evidencefilename']."</td>";
                echo "<td><i class='".displayfiletypeicon($d['evidencefiletype'])."'></i> ".$d['evidencefiletype']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick=\"window.open('".$dir.$d['evidencefilename']."', '_blank');\"><i class='fa fa-eye'></i></button> <button type='button' name='btndelete' id='btndelete' class='btn btn-danger confirm-delete'   title='Delete' data-href='editmyreport.php?id=".$rpttoken."&rid=".$d['reportrefno']."&eid=".$d['evidenceid']."&success' data-toggle='modal' data-target='#delete'><i class='far fa-trash-alt'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function getevidencefilename($dbh, $evidenceid)
{
    $data = ["evidenceid" => $evidenceid];
    $sql = "SELECT evidencefilename FROM evidences WHERE evidenceid = :evidenceid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['evidencefilename'];
    }
}

function deletereportevidence($dbh, $reportrefno, $evidenceid)
{
    $opdelete = false;
    $path = "../evidences/";
    $data = ["rptrefno" => $reportrefno, "evidenceid" => $evidenceid];
    $evidencefilename = getevidencefilename($dbh, $evidenceid);
    $sql = "DELETE FROM evidences WHERE reportrefno = :rptrefno AND evidenceid = :evidenceid";
    
    if(unlink($path.$evidencefilename))
    {
        $stmt = $dbh->prepare($sql);
        if($stmt->execute($data))
        {
            $opdelete = true;
        }    
    }    
        
    return $opdelete;        
}
/////end: permanent staff functions/////

/////start: system administrator functions/////
function listusers($dbh, $roleid)
{
    if($roleid == 1) //sys admin
    {        
        $sql = "SELECT u.USER_ID, u.USER_NAME, u.JABATAN, r.roletitle, IF(s.allowedaccess = 1, 'YES', 'NO') as isallowed, s.created_at, s.userroleid FROM classbook_backup_jengka.vw_staff_phg u JOIN attendancerptdb.user_roles s ON u.USER_ID = s.USER_ID JOIN attendancerptdb.roles r ON s.roleid = r.roleid LEFT JOIN classbook_backup_jengka.vw_fakulti_phg j ON u.USER_DEPTCAMPUS = j.JA_KOD_JABATAN";
    }
    else if($roleid == 4) //hea -> view kpp and koordinator only
    {
        $sql = "SELECT u.USER_ID, u.USER_NAME, u.JABATAN, r.roletitle, IF(s.allowedaccess = 1, 'YES', 'NO') as isallowed, s.created_at, s.userroleid FROM classbook_backup_jengka.vw_staff_phg u JOIN attendancerptdb.user_roles s ON u.USER_ID = s.USER_ID JOIN attendancerptdb.roles r ON s.roleid = r.roleid LEFT JOIN classbook_backup_jengka.vw_fakulti_phg j ON u.USER_DEPTCAMPUS = j.JA_KOD_JABATAN WHERE s.roleid IN (2, 3)";    
    }
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['JABATAN']."</td>";
                echo "<td>".$d['roletitle']."</td>";                
                echo "<td>".$d['isallowed']."</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewuser.php?id=".$d['userroleid']."\";'><i class='fa fa-eye'></i></button> <button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"edituser.php?id=".$d['userroleid']."\";'><i class='fas fa-pencil-alt'></i></button></td>";
                    
            echo "</tr>";
            $count++;
        }
    }
}

function listlecturers($dbh)
{
    $sql = "SELECT u.USER_ID, u.USER_NAME, u.JABATAN, u.USER_DEPTCAMPUS, f.JABATAN AS JAB_KAMPUS, c.JABATAN AS CAMPUS
    FROM classbook_backup_jengka.vw_staff_phg u 
    JOIN classbook_backup_jengka.vw_fakulti_phg f ON u.USER_DEPTCAMPUS = f.JA_KOD_JABATAN
    JOIN classbook_backup_jengka.jabatan c ON u.USER_DEPARTMENT = c.JA_KOD_JAB
    WHERE u.JA_KOD_JABATAN NOT IN ('C0001', 'C0010')
    ORDER BY u.JA_KOD_JABATAN ASC, u.USER_NAME ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['JABATAN']."</td>";
                echo "<td>".$d['JAB_KAMPUS']."</td>";
                echo "<td>".$d['CAMPUS']."</td>";
                echo "<td><button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"editlecturer.php?id=".$d['USER_ID']."\";'><i class='fas fa-pencil-alt'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function listlecturersbykpp($dbh, $userid)
{
    $data = ["userid" => $userid];
    $sql = "SELECT u.USER_ID, u.USER_NAME, u.JABATAN, u.USER_DEPTCAMPUS, f.JABATAN AS JAB_KAMPUS, c.JABATAN AS CAMPUS
            FROM classbook_backup_jengka.vw_staff_phg u 
            JOIN classbook_backup_jengka.vw_fakulti_phg f ON u.USER_DEPTCAMPUS = f.JA_KOD_JABATAN
            JOIN classbook_backup_jengka.jabatan c ON u.USER_DEPARTMENT = c.JA_KOD_JAB
            WHERE u.USER_DEPTCAMPUS = (select u.USER_DEPTCAMPUS 
            from classbook_backup_jengka.`vw_staff_phg` u 
            where u.USER_ID = :userid)
            ORDER BY u.USER_NAME asc, u.JA_KOD_JABATAN ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['JABATAN']."</td>";
                echo "<td>".$d['JAB_KAMPUS']."</td>";
                echo "<td>".$d['CAMPUS']."</td>";
                echo "<td><button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"editlecturer.php?id=".$d['USER_ID']."\";' disabled><i class='fas fa-pencil-alt'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function updatelecturer($dbh3, $staffno, $deptcampus)
{
    $data = ["userid" => $staffno, "deptcampus" => $deptcampus];
    $sql = "UPDATE vw_staff_phg SET USER_DEPTCAMPUS = :deptcampus WHERE
        USER_ID = :userid";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
}

function listptfts($dbh, $dbh3, $facultyid, $roleid)
{
    $allowedallptfts = array(1, 4); //sys admin, hea
    $allowedselectedptfts = array(2, 3); //kpp, koordinator
    //$allowedroles = array(2, 3);
    //$sql = "SELECT p.*, j.*, IF(p.isactive = 1, 'YES', 'NO') as isactive FROM dbptftphg.ptfts p JOIN classbook_backup_jengka.vw_fakulti_phg j ON p.JA_KOD_JAB = j.JA_KOD_JABATAN";
    $sql = "SELECT U.*, IF(U.USER_SIRSACCESS = 1, 'YES', 'NO') AS USER_SIRSACCESS
            FROM classbook_backup_jengka.vw_staff_phg U 
            WHERE U.USER_KODJAWATAN IN ('Z110', 'Z080')";
    if(in_array($roleid, $allowedallptfts)) //sysadmin, hea
    {
        $sql = $sql;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    }
    else if(in_array($roleid, $allowedselectedptfts))//kpp, koordinator
    {
        $data = ["facultyid" => $facultyid];
        //$sql = $sql . " WHERE p.JA_KOD_JAB = :facultyid"; //asal
        $sql = $sql . " AND U.USER_DEPTCAMPUS = :facultyid"; //new
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }   */ 
    
   /* $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            /*echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['PTFT_ID']."</td>";
                echo "<td>".$d['fullname']."</td>";
                echo "<td>".$d['icnum']."</td>";
                echo "<td>".$d['JABATAN']."</td>";
                echo "<td>".$d['isactive']."</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewptft.php?id=".$d['ptfttoken']."\";'><i class='fa fa-eye'></i></button> <button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"editptft.php?id=".$d['ptfttoken']."\";'><i class='fas fa-pencil-alt'></i></button></td>";
            echo "</tr>";*/
          /* echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['USER_ICNO']."</td>";
                echo "<td>".getDepartmentTitle($dbh3, $d['JA_KOD_JABATAN'])."</td>";
                echo "<td>".getDepartmentTitle($dbh3, $d['USER_DEPTCAMPUS'])."</td>";
                echo "<td>".getDepartmentTitle($dbh3, $d['USER_DEPARTMENT'])."</td>";
                 echo "<td>".$d['USER_SIRSACCESS']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewptft.php?id=".$d['USER_ID']."\";'><i class='fa fa-eye'></i></button> <button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"editptft.php?id=".$d['USER_ID']."\";'><i class='fas fa-pencil-alt'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}

function checkuserrecord($dbh, $id)
{
    $found = false;
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg u JOIN attendancerptdb.user_roles a ON u.USER_ID = a.USER_ID WHERE a.userroleid = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

function checklecturerrecord($dbh, $id)
{
    $found = false;
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg u  WHERE u.USER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

function getstaffno($dbh, $userroleid)
{
    $data = ["userroleid" => $userroleid];
    $sql = "SELECT * FROM attendancerptdb.user_roles WHERE userroleid = :userroleid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_ID'];
    }   
}

function getstaffname($dbh3, $user_id)
{
    $data = ["user_id" => $user_id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg WHERE USER_ID = :user_id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_NAME'];
    }
}

function getstafffacultyid($dbh3, $user_id)
{
    $data = ["user_id" => $user_id];
    $sql = "SELECT USER_DEPTCAMPUS FROM classbook_backup_jengka.vw_staff_phg WHERE USER_ID = :user_id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_DEPTCAMPUS'];
    }
}

function getstafffaculty($dbh3, $user_id)
{
    $data = ["user_id" => $user_id];
    $sql = "SELECT JABATAN FROM classbook_backup_jengka.vw_staff_phg WHERE USER_ID = :user_id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['JABATAN'];
    }
}

function getroletitle($dbh, $userroleid)
{
    $data = ["userroleid" => $userroleid]; 
    $sql = "SELECT * FROM attendancerptdb.user_roles a JOIN attendancerptdb.roles r ON a.roleid = r.roleid WHERE a.userroleid = :userroleid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['roletitle'];
    }
}

function getAccessIsAllowed($dbh, $userroleid)
{
    $data = ["userroleid" => $userroleid]; 
    $sql = "SELECT * FROM attendancerptdb.user_roles a WHERE a.userroleid = :userroleid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['allowedaccess'];
    }
}

function saveuser($dbh, $staffno, $roleid, $isallowed)
{
    $created_at = getTimestamp();
    $token = generateToken(32);
    $data = ["staffno" => $staffno, "roleid" => $roleid, "isallowed" => $isallowed, "token" => $token, "created_at" => $created_at];
    $sql = "INSERT INTO attendancerptdb.user_roles (USER_ID, roleid, allowedaccess, accesstoken, created_at) VALUES (:staffno, :roleid, :isallowed, :token, :created_at)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
}

function getrolelist($dbh, $roleid)
{
    if($roleid == 1)
        $sql = "SELECT * FROM attendancerptdb.roles ORDER BY roletitle ASC";
    else if($roleid == 4)
        $sql = "SELECT * FROM attendancerptdb.roles WHERE roleid IN (2, 3) ORDER BY roletitle ASC";
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['roleid']."'>".$d['roletitle']."</option>";
        }
    }
}

function getSelectedRolesList($dbh, $roleid, $superroleid)
{
    if($superroleid == 1)
        $sql = "SELECT * FROM attendancerptdb.roles ORDER BY roletitle ASC";
    else if($superroleid == 4)
        $sql = "SELECT * FROM attendancerptdb.roles WHERE roleid IN (2, 3) ORDER BY roletitle ASC";
        
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if($d['roleid'] == $roleid)
            {
                echo "<option value='".$d['roleid']."' selected>".$d['roletitle']."</option>";
            }
            else
            {
                echo "<option value='".$d['roleid']."'>".$d['roletitle']."</option>";
            }          
        }
    }
}

function getroleid($dbh, $userroleid)
{
    $data = ["userroleid" => $userroleid]; 
    $sql = "SELECT * FROM attendancerptdb.user_roles a WHERE a.userroleid = :userroleid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['roleid'];
    }
}

function updateuser($dbh, $userroleid, $roleid, $isallowed)
{
    $updated_at = getTimestamp();
    $data = ["userroleid" => $userroleid, "roleid" => $roleid, 
            "isallowed" => $isallowed, "updated_at" => $updated_at];
    $sql = "UPDATE attendancerptdb.user_roles SET roleid = :roleid, allowedaccess = :isallowed, updated_at = :updated_at
            WHERE userroleid = :userroleid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
}

function checkptftrecord($dbh2, $id)
{
    $found = false;
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.user WHERE BINARY USER_ID = :id";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $found = true;    
    }
    
    return $found;
}

//will be removed
function getptftid($dbh2, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM dbptftphg.ptfts WHERE BINARY ptfttoken = :id";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['PTFT_ID'];
    }
}

//will be removed
function getptfttoken($dbh2, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM dbptftphg.ptfts WHERE BINARY PTFT_ID = :id";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['ptfttoken'];
    }
}

function getptftname($dbh3, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg WHERE BINARY USER_ID = :id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_NAME'];
    }
}

function getptfticnum($dbh3, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg WHERE BINARY USER_ID = :id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_ICNO'];
    }
}

function getptftfaculty($dbh3, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg WHERE BINARY USER_ID = :id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_DEPTCAMPUS'];
    }
}

function getptftuitmemail($dbh3, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.vw_staff_phg WHERE BINARY USER_ID = :id";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_EMAIL'];
    }
}

//will be removed
/*function getptftaltemail($dbh2, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM dbptftphg.ptfts WHERE BINARY ptfttoken = :id";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['emailaddressalternate'];
    }
}

function getptftcontactnum($dbh2, $id)
{
    $data = ["id" => $id];
    $sql = "SELECT * FROM classbook_backup_jengka.user WHERE BINARY USER_ID = :id";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_MOBNO'];
    }
}*/

/*function getPtftIsActive($dbh2, $id)
{
    $data = ["id" => $id]; 
    $sql = "SELECT * FROM classbook_backup_jengka.user WHERE BINARY USER_ID = :id";
    $stmt = $dbh2->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_SIRSACCESS'];
    }
}

function updateptft($dbh3, $ptftid, $ptftfaculty, $isallowed)
{
    $updated_at = getTimestamp();
    $data = ["ptftid" => $ptftid, "faculty" => $ptftfaculty, 
             "isallowed" => $isallowed, "isallowed" => $isallowed, "updated_at" => $updated_at];
    $sql = "UPDATE classbook_backup_jengka.user SET 
            USER_DEPTCAMPUS = :faculty,
            USER_SIRSACCESS = :isallowed, 
            USER_DATEUPDATE = :updated_at
            WHERE BINARY USER_ID = :ptftid";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
}

function getDepartmentTitle($dbh3, $jakodjab)
{
    $data = ["jakodjab" => $jakodjab]; 
    $sql = "SELECT * FROM classbook_backup_jengka.jabatan j WHERE BINARY j.JA_KOD_JAB = :jakodjab";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['JABATAN'];
    }
}
/////end: system administrator functions/////

/////start: dashboard info except for hea/////
function displayReportsOnDashboard($dbh, $userid)
{
    $data = ["userid" => $userid];
    $sql = "SELECT r.reporttoken, s.SEMESTER_ID, s.SEMESTER_NAME, c.code_course, c.name_course_eng, r.reportgroup, m.monthtitle, r.reportyear, r.reporthea, r.created_at 
            FROM attendancerptdb.reports r
            JOIN attendancerptdb.months m ON r.reportmonth = m.monthid
            JOIN classbook_backup_jengka.semester s ON r.SEMESTER_ID = s.SEMESTER_ID
            JOIN classbook_backup_jengka.vw_active_courses c ON r.reportcourse = c.course_id
            WHERE s.SEMESTER_ACTIVE = 1 AND r.USER_ID = :userid AND
            r.deleted_at IS NULL
            ORDER BY m.monthid DESC, r.reportyear DESC, c.code_course ASC, r.reportgroup ASC, r.created_at DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['SEMESTER_ID']." - ".$d['SEMESTER_NAME']."</td>";
                echo "<td>".$d['code_course']." - ".$d['name_course_eng']."</td>";
                echo "<td>".$d['reportgroup']."</td>";
                echo "<td>".$d['monthtitle']." ".$d['reportyear']."</td>";
                echo "<td align='center'>";
                    if($d['reporthea'] == 1)
                    {
                        echo "<i class='fas fa-bullhorn'></i>";
                    }
                echo "</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"../myreports/viewmyreport.php?id=".$d['reporttoken']."\";'><i class='fa fa-eye'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}
/////end: dashboard info except for hea/////
//start: sys admin dashboard info boxes
function getTotalSubmittedReport($dbh) //sys admin, hea
{
    $sql = "select COUNT(*) as Tot_Submitted_Reports
            from attendancerptdb.reports r 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where r.deleted_at IS NULL AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Submitted_Reports'];
    }
}

function getTotalEvidence($dbh) //sys admin, hea
{
    $sql = "select COUNT(*) as Tot_Evidence
            from attendancerptdb.reports r 
            join attendancerptdb.evidences e on r.reportrefno = e.reportrefno
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Evidence'];
    }
}

function getEvidenceUsedMemory($dbh) //sys admin
{
    $sql = "select round(sum(e.evidencefilesize / 1000000), 2) as Size_Evidence
            from attendancerptdb.reports r 
            join attendancerptdb.evidences e on r.reportrefno  = e.reportrefno 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Size_Evidence']." MB";
    }
}

function getLecturerInvolved($dbh) //sys admin
{
    $sql = "select COUNT(DISTINCT r.USER_ID) as Tot_Lecturer
            from attendancerptdb.reports r 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Lecturer'];
    }
}
//end: sys admin dashboard info boxes

//start: kpp/koordinator dashboard info boxes
function getTotalReportByFaculty($dbh, $jakodjabatan)
{
    $data = ["facultyid" => $jakodjabatan];
    $sql = "SELECT COUNT(*) AS TOTAL 
            FROM classbook_backup_jengka.vw_staff_phg vsp
            JOIN attendancerptdb.reports r on vsp.USER_ID = r.USER_ID
            JOIN classbook_backup_jengka.semester s ON r.SEMESTER_ID = s.SEMESTER_ID
            WHERE vsp.USER_DEPTCAMPUS = :facultyid 
            AND r.deleted_at IS NULL AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['TOTAL'];
    }
}

function getTotalReportLecturerByFaculty($dbh, $jakodjabatan)
{
    $data = ["facultyid" => $jakodjabatan];
    $sql = "SELECT COUNT(DISTINCT vsp.USER_ID) AS TOTAL 
            FROM classbook_backup_jengka.vw_staff_phg vsp
            JOIN attendancerptdb.reports r on vsp.USER_ID = r.USER_ID
            JOIN classbook_backup_jengka.semester s ON r.SEMESTER_ID = s.SEMESTER_ID
            WHERE vsp.USER_DEPTCAMPUS = :facultyid 
            AND r.deleted_at IS NULL AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['TOTAL'];
    }
}
//end: kpp/koordinator dashboard info boxes

//start: individual total report (kpp, koordinator, lecturer + ptft)
function getTotalReportByUser($dbh, $userid)//kpp, koordinator, lecturer
{
    $data = ["userid" => $userid];
    $sql = "SELECT COUNT(*) AS TOTAL 
            FROM attendancerptdb.reports r 
            JOIN classbook_backup_jengka.semester s ON r.SEMESTER_ID = s.SEMESTER_ID
            WHERE r.USER_ID = :userid AND r.deleted_at IS NULL AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['TOTAL'];
    }
}
//end: individual total report (kpp, koordinator)
//start: individual total evidence (kpp, koordinator, lecturer + ptft)
function getTotalEvidenceByUser($dbh, $userid)//kpp, koordinator, lecturer
{
    $data = ["userid" => $userid];
    $sql = "select COUNT(*) as Tot_Evidence
            from attendancerptdb.reports r 
            join attendancerptdb.evidences e on r.reportrefno  = e.reportrefno 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where r.USER_ID = :userid AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Evidence'];
    }
}
//end: individual total evidence (kpp, koordinator, lecturer + ptft)
//start: individual total courses (lecturer + ptft)
function getTotalCoursesByUser($dbh, $userid)
{
    $data = ["userid" => $userid];
    $sql = "select COUNT(distinct r.reportcourse) as Tot_Courses
            from attendancerptdb.reports r 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where r.USER_ID = :userid AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Courses'];
    }
}
//end: individual total courses (lecturer + ptft)
//start: individual total hea reports (lecturer + ptft)
function getTotalHeaReportByUser($dbh, $userid)
{
    $data = ["userid" => $userid];
    $sql = "select COUNT(*) as Tot_Courses
            from attendancerptdb.reports r 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where r.USER_ID = :userid AND r.reporthea = 1 AND r.deleted_at IS NULL AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Courses'];
    }
}
//end: individual total hea reports (lecturer + ptft)
//start: individual total hea reports (lecturer + ptft)
function getTotalHeaReport($dbh)
{
    $data = ["userid" => $userid];
    $sql = "select COUNT(*) as Tot_Courses
            from attendancerptdb.reports r 
            join classbook_backup_jengka.semester s on r.SEMESTER_ID = s.SEMESTER_ID 
            where r.reporthea = 1 AND r.deleted_at IS NULL AND s.SEMESTER_ACTIVE = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['Tot_Courses'];
    }
}
//end: individual total hea reports (lecturer + ptft)

//start: load kpp 
//date added: 4th july 2021
function getKpp($dbh)
{
    $sql = "SELECT vsp.USER_ID, vsp.USER_NAME, vsp.USER_DEPTCAMPUS, vfp.JABATAN 
FROM attendancerptdb.user_roles ur 
JOIN classbook_backup_jengka.vw_staff_phg vsp 
ON ur.USER_ID = vsp.USER_ID
join classbook_backup_jengka.vw_fakulti_phg vfp 
on vsp.USER_DEPTCAMPUS = vfp.JA_KOD_JABATAN 
WHERE ur.roleid IN (2) AND ur.allowedaccess = 1
order by vfp.JABATAN ASC, vsp.USER_NAME asc";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['USER_ID']."'>".$d['JABATAN']." - ".$d['USER_NAME']."</option>";    
        }
    }
}
//end: load kpp

//start: get kpp userid
function getKppUserId($dbh, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT USER_ID_KPP FROM attendancerptdb.reports WHERE BINARY reporttoken = :rpttoken";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['USER_ID_KPP'];
    }
}
//end: load kpp

//start: get selected kpp userid
function getSelectedKpp($dbh3, $kppuserid)
{
    $sql = "SELECT vsp.USER_ID, vsp.USER_NAME, vsp.USER_DEPTCAMPUS, vfp.JABATAN 
FROM attendancerptdb.user_roles ur 
JOIN classbook_backup_jengka.vw_staff_phg vsp 
ON ur.USER_ID = vsp.USER_ID
join classbook_backup_jengka.vw_fakulti_phg vfp 
on vsp.USER_DEPTCAMPUS = vfp.JA_KOD_JABATAN 
WHERE ur.roleid IN (2) AND ur.allowedaccess = 1
order by vsp.USER_NAME asc";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if($d['USER_ID'] == $kppuserid)
                echo "<option value='".$d['USER_ID']."' selected>".$d['JABATAN']." - ".$d['USER_NAME']."</option>"; 
            else
                echo "<option value='".$d['USER_ID']."'>".$d['JABATAN']." - ".$d['USER_NAME']."</option>"; 
        }
    }
}
//end: get selected kpp userid
//start: get kpp name
function getKppName($dbh3, $rpttoken)
{
    $data = ["rpttoken" => $rpttoken];
    $sql = "SELECT vsp.USER_ID, vsp.USER_NAME, vsp.USER_DEPTCAMPUS, vfp.JABATAN 
            FROM attendancerptdb.reports r 
            JOIN classbook_backup_jengka.vw_staff_phg vsp 
            ON r.USER_ID_KPP = vsp.USER_ID
            JOIN classbook_backup_jengka.vw_fakulti_phg vfp 
            on vsp.USER_DEPTCAMPUS = vfp.JA_KOD_JABATAN 
            WHERE BINARY r.reporttoken = :rpttoken";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return trim($d['JABATAN']) . " - " . $d['USER_NAME'];
    }
}
//end: get kpp name

//start: audit
function listauditlogins($dbh)
{
    $sql = "SELECT a.USER_ID, vsp.USER_NAME, IF(r.roletitle is null, 'LECTURER', r.roletitle) as roletitle, a.auditipaddress, 
    a.auditlocation, a.auditlogindatetime, a.auditlogoutdatetime
    FROM attendancerptdb.auditlogins a 
    JOIN classbook_backup_jengka.vw_staff_phg vsp ON a.USER_ID = vsp.USER_ID
    LEFT JOIN attendancerptdb.roles r ON a.roleid = r.roleid
    ORDER BY a.auditlogindatetime DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['roletitle']."</td>";
                echo "<td>".$d['auditipaddress']."</td>";
                echo "<td>".$d['auditlocation']."</td>";
                echo "<td>".$d['auditlogindatetime']."</td>";
                echo "<td>".$d['auditlogoutdatetime']."</td>";
            echo "</tr>";
            $count++;
        }
    }
}

function listauditemails($dbh)
{
    $sql = "SELECT a.PTFT_ID, vsp.USER_NAME, vsp2.USER_ID, vsp2. USER_NAME AS RECEIVERNAME,
    a.receiveremail, upper(a.sendstatus) AS STATUS, upper(a.type) AS TYPES, a.created_at
    FROM attendancerptdb.auditemails a 
    JOIN classbook_backup_jengka.vw_staff_phg vsp ON a.PTFT_ID = vsp.USER_ID
    JOIN classbook_backup_jengka.vw_staff_phg vsp2 ON a.receiveremail = vsp2.USER_EMAIL
    ORDER BY a.created_at DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['PTFT_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['RECEIVERNAME']."</td>";
                echo "<td>".$d['receiveremail']."</td>";
                echo "<td>".$d['STATUS']."</td>";
                echo "<td>".$d['TYPES']."</td>";
                echo "<td>".$d['created_at']."</td>";
            echo "</tr>";
            $count++;
        }
    }
}
//end: audit

//start: submission records
function getSubmissionRecordsFacultyByRole($dbh, $month, $year, $facultyid)
{
    $allowedroles = array(2, 3);
    $data = ["month" => $month, "year" => $year, "facultyid" => $facultyid];
    $sql = "select 
                distinct r.USER_ID, vsp.USER_NAME, m.monthtitle, r.reportyear, 
                count(r.reportid) AS noOfReports
            from 
                attendancerptdb.reports r 
            join 
                classbook_backup_jengka.vw_staff_phg vsp on r.USER_ID = vsp.USER_ID 
            join 
	            attendancerptdb.months m on r.reportmonth = m.monthid
            where 
                vsp.USER_DEPTCAMPUS = :facultyid and r.reportmonth = :month and r.reportyear = :year
            group by 
                r.USER_ID, vsp.USER_NAME
            union
            select 
                distinct vsp2.USER_ID, vsp2.USER_NAME, '','', coalesce(null, 0)
            from 
                classbook_backup_jengka.vw_staff_phg vsp2 
            where 
                vsp2.USER_ID not in (select r.USER_ID
                    from attendancerptdb.reports r 
                    right join classbook_backup_jengka.vw_staff_phg vsp on r.USER_ID = vsp.USER_ID 
                    where vsp.USER_DEPTCAMPUS = :facultyid and r.reportmonth = :month and r.reportyear = :year
                    group by r.USER_ID)
            and 
                vsp2.USER_DEPTCAMPUS = :facultyid
            order by 
                2 asc";

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['USER_ID']."</td>";
                echo "<td>".$d['USER_NAME']."</td>";
                echo "<td>".$d['monthtitle']." ".$d['reportyear']."</td>";
                echo "<td>".$d['noOfReports']."</td>";
                //echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewreport.php?id=".$d['reporttoken']."\";'><i class='fa fa-eye'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}
//end: submission records

//added: Monday, 4 october 2021
function listsemesters($dbh)
{
    $sql = "SELECT a.SEMESTER_ID, b.SEMESTER_NAME, IF(a.isactive = 1, 'YES', 'NO') AS isactive, a.created_at, a.token FROM attendancerptdb.semesters a JOIN classbook_backup_jengka.semester b ON a.SEMESTER_ID = b.SEMESTER_ID ORDER BY a.created_at DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount >= 0)
    {
        $count = 0;
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>".($count + 1)."</td>";
                echo "<td>".$d['SEMESTER_ID']."</td>";
                echo "<td>".$d['SEMESTER_NAME']."</td>";
                echo "<td>".$d['isactive']."</td>";
                echo "<td>".$d['created_at']."</td>";
                echo "<td><button type='button' name='view' class='btn btn-info' title='View' onclick='window.location=\"viewsemester.php?id=".$d['token']."\";'><i class='fa fa-eye'></i></button> <button type='button' name='edit' class='btn btn-info' title='Edit' onclick='window.location=\"editsemester.php?id=".$d['token']."\";'><i class='fas fa-pencil-alt'></i></button></td>";
            echo "</tr>";
            $count++;
        }
    }
}
function getsemesterlist($dbh)
{
    $sql = "SELECT * FROM classbook_backup_jengka.semester ORDER BY SEMESTER_ID ASC";    
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        while($d = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo "<option value='".$d['SEMESTER_ID']."'>".$d['SEMESTER_ID']. " - ".$d['SEMESTER_NAME']."</option>";
        }
    }
}
function checksemesterexist($dbh, $semesterid)
{
    $status = false;
    $data = ["semid" => $semesterid];  
    $sql = "SELECT SEMESTER_ID FROM attendancerptdb.semesters WHERE SEMESTER_ID = :semid";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $status = true;
    }
    return $status;
}
function checksemesteractive($dbh)
{
    $status = false;
    $data = ["semid" => $semesterid];  
    $sql = "SELECT SEMESTER_ID FROM attendancerptdb.semesters WHERE isactive = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $status = true;
    }
    return $status;
}
function savesemester($dbh, $semesterid, $isactive, $userid)
{
    $status = false;
    $token = generateToken(32);
    $data = ["semid" => $semesterid, "isactive" => $isactive, "token" => $token, "userid" => $userid];  
    $sql = "INSERT INTO attendancerptdb.semesters (SEMESTER_ID, isactive, token, inserted_by) VALUES (:semid, :isactive, :token, :userid)";
    $stmt = $dbh->prepare($sql);

    if($stmt->execute($data))
        $status = true;
    
    return $status;
}
function updatesemester($dbh, $semesterid, $isactive, $userid)
{
    $status = false;
    $updated_at = getTimestamp();
    $token = generateToken(32);
    $data = ["semid" => $semesterid, "isactive" => $isactive, "userid" => $userid, "updatedat" => $updated_at];  
    $sql = "UPDATE attendancerptdb.semesters SET isactive = :isactive, updated_by = :userid, updated_at = :updatedat WHERE SEMESTER_ID = :semid";
    $stmt = $dbh->prepare($sql);

    if($stmt->execute($data))
        $status = true;
    
    return $status;
}
function getsemesterid($dbh, $token)
{
    $data = ["token" => $token];
    $sql = "SELECT a.SEMESTER_ID FROM attendancerptdb.semesters a WHERE BINARY a.token = :token";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['SEMESTER_ID'];
    }
}
function getsemestername($dbh, $token)
{
    $data = ["token" => $token];
    $sql = "SELECT b.SEMESTER_NAME FROM attendancerptdb.semesters a JOIN classbook_backup_jengka.semester b ON a.SEMESTER_ID = b.SEMESTER_ID WHERE BINARY a.token = :token";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['SEMESTER_NAME'];
    }
}
function getsemesterisactive($dbh, $token)
{
    $data = ["token" => $token];
    $sql = "SELECT a.isactive FROM attendancerptdb.semesters a WHERE BINARY a.token = :token";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['isactive'];
    }
}
function getSemesterActiveLocalDb($dbh3)
{
    $sql = "SELECT SEMESTER_ID FROM attendancerptdb.semesters WHERE isactive = 1";
    $stmt = $dbh3->prepare($sql);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if($rowCount > 0)
    {
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $d['SEMESTER_ID'];
    }
}*/
?>