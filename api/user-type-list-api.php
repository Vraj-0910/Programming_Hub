<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    $response = array();


    $query_user_type = mysqli_query($conn, "select * from tbl_user_type where is_delete='0' and is_active='1'") or die(mysqli_error($conn));
    $count = mysqli_num_rows($query_user_type);

    //this condition check usertype data is greater than 0
    if ($count > 0) {
        
        $response["flag"] = "1";
        $response["message"] = "$count Record Found";
        
        $response["user_type"] = array();
        while ($row = mysqli_fetch_array($query_user_type)) {
            $temparray = array();

            $temparray["user_type_id"] = $row["user_type_id"];
            $temparray["user_type_name"] = $row["user_type_name"];
       //      $temparray["user_type_name_initials"] = $row["user_type_name_initials"];
//              $string = $row["user_type_name"];
//                $stringLength= strlen($string);
//               $user_type_name_initials=ucfirst(substr($string,-$stringLength-1, 1));
//               $response["user_name_initials"] = $user_type_name_initials;
            
              $title = $row["user_type_name"];
                $user_name_initials = ucfirst(mb_substr($title, 0, 1));
               
                if($user_name_initials == '.')
               {
                   $user_name_initials = ucfirst(mb_substr($title, 1, 1));
               }
                
                
             //  $response["user_name_type_initials"] = $user_name_initials;
  $temparray["user_type_name_initials"] = $user_name_initials;

            array_push($response["user_type"], $temparray);
        }
    }
    //no record found
    else {
        $response["flag"] = "0";
        $response["message"] = "No Record Found";
    }
}
//authentication not flag then not access
else {

    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    $response["flag"] = "0";
    $response['message'] = 'Sorry You Are not Allow to access';
}
echo json_encode($response);
?>