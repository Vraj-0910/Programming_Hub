<?php
require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();
    //required field condition check
    if ((isset($_POST["user_id"]))) {
        
        
        //blank field condition check
        if ($_POST["user_id"] != '') {
            
            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            
             //check mobile number already exist or not
            $query_check_user = mysqli_query($conn, "select * from tbl_users where user_id='{$user_id}'")or die(mysqli_error($conn));

            $count = mysqli_num_rows($query_check_user);
            if ($count > 0) {
                
                $row_user = mysqli_fetch_array($query_check_user);
                
               //   $string = ".ramshsha";
//                 $string = $row_user["user_name"];
//               $stringLength= strlen($string);
//               $user_type_name_initials=ucfirst(substr($string,-$stringLength-1, 1));
               
//               if($user_type_name_initials =='.')
//               {
//                       $user_type_name_initials=ucfirst(substr($string,-$stringLength-1, 2));
//               }
//               else{
//                   
//               }
               
               $response["flag"] = "1";
               $response["user_name"] = $row_user["user_name"];
               $response["greeting"] = "Hello";
               
                $title = $row_user["user_name"];
                $user_name_initials = ucfirst(mb_substr($title, 0, 1));
               
                if($user_name_initials == '.')
               {
                   $user_name_initials = ucfirst(mb_substr($title, 1, 1));
               }
                
                
               $response["user_name_initials"] = $user_name_initials;
     
               
        $response["message"] = "User Record Found";
            } 
            else{
                   $response["flag"] = '0';
                $response["message"] = "Your Record Not Found";
            }
            
            
            
        }
         //if any field is blank then this condition true
        else {
            $response["flag"] = '0';
            $response["message"] = "All Field Is Required";
        }
        
        
        
    }
    //if any field is missing then this condition true
    else {
        $response["flag"] = '0';
        $response["message"] = "Required Field Is Missing";
    }
    
    
    
    } else {

    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    $response["flag"] = "0";
    $response['message'] = 'Sorry You Are not Allow to access';
}

echo json_encode($response);
?>