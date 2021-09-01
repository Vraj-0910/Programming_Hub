<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

    //required field condition check
    if ((isset($_POST["user_mobile"])) && (isset($_POST["mobile_otp"]))) {

        //blank field condition check
        if ($_POST["user_mobile"] != '' && $_POST["mobile_otp"] != '') {
            $user_mobile = mysqli_real_escape_string($conn, $_POST["user_mobile"]);
             $otp = mysqli_real_escape_string($conn, $_POST["mobile_otp"]);
            $selectquery = mysqli_query($conn, "select * from tbl_users where user_mobile='{$user_mobile}' and mobile_otp='{$otp}'")or die(mysqli_error($conn));
            $count = mysqli_num_rows($selectquery);
            $row = mysqli_fetch_array($selectquery);
            //this condition check tbl_usermaster data is greater than 0
            if ($count > 0) {
               $querycontactupdate = mysqli_query($conn,"UPDATE `tbl_users` SET `is_mobile_verify`='1',`is_login`='1' WHERE user_id='{$row['user_id']}'") or die(mysqli_error($conn));
                $response["flag"] = '1';
                $response["user_id"] = $row['user_id'];
                $response["user_name"] = $row['user_name'];
                $response["user_email"] = $row['user_email'];
                $response["user_mobile"] = $row['user_mobile'];
                 $response["unique_no"] = $row['unique_no'];
              $response["user_type_id"] = $row['user_type_id'];
              $query_user_type = mysqli_query($conn, "select * from tbl_user_type where user_type_id='{$row['user_type_id']}'")or die(mysqli_error($conn));     
               $row_user_type = mysqli_fetch_array($query_user_type);
                $response["user_type_name"] = $row_user_type['user_type_name'];
                 
                $response["message"] = "OTP Verified Successfully.";
            } else {

                $response["flag"] = '0';
                $response["message"] = "OTP Did Not Match";
            }
        } //if any field is blank then this condition true
        else {
            $response["flag"] = '0';
            $response["message"] = "All Field Is Required";
        }
    }  //if any field is missing then this condition true
    else {
        $response["flag"] = '0';
        $response["message"] = "Required Field Is Missing";
    }
}


//if authentication failed then this condition true
else {

    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    $response['flag'] = 'Sorry You Are not Allow to access';
}
echo json_encode($response);
?>