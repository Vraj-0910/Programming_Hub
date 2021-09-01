<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

    //required field condition check
    if ((isset($_POST["user_mobile"])) && isset($_POST["user_type_id"])) {

        //blank field condition check
        if ($_POST["user_mobile"] != '' && $_POST["user_type_id"] != '') {
            $user_mobile = mysqli_real_escape_string($conn, $_POST["user_mobile"]);
            $user_type_id = mysqli_real_escape_string($conn, $_POST["user_type_id"]);
            $selectquery = mysqli_query($conn, "select * from tbl_users where user_mobile='{$user_mobile}' and user_type_id='{$user_type_id}'")or die(mysqli_error($conn));
            $count = mysqli_num_rows($selectquery);
            $row = mysqli_fetch_array($selectquery);
            //this condition check tbl_usermaster data is greater than 0
            if ($count > 0) {

                if ($row['user_mobile'] == '9586248516') {
                    $otp = '958624';
                } else {
                    $otp = '898032';
                }

                $response["flag"] = '1';
                $response["user_mobile"] = $row['user_mobile'];
                $response["message"] = "OTP Send On Your Registered Mobile Number";
            } else {

                $response["flag"] = '0';
                $response["message"] = "Mobile Number Not Matched";
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