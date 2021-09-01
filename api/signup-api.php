<?php
require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

//required field condition check
    if ((isset($_POST["user_name"])) && isset($_POST["user_email"]) && isset($_POST["user_mobile"]) && isset($_POST["user_password"]) && isset($_POST["user_type_id"])) {
        //blank field condition check
        if ($_POST["user_name"] != '' && $_POST["user_email"] != '' && $_POST["user_mobile"] != '' && $_POST["user_password"] != '' && $_POST["user_type_id"] != '') {

            $user_mobile = mysqli_real_escape_string($conn, $_POST["user_mobile"]);
             
            //check mobile number already exist or not
            $query_check_mobile = mysqli_query($conn, "select * from tbl_users where user_mobile='{$user_mobile}'")or die(mysqli_error($conn));

            $count = mysqli_num_rows($query_check_mobile);
            if ($count > 0) {
                $response["flag"] = '0';
                $response["message"] = "Mobiler Number Already Exist";
            } else {

                $user_name = mysqli_real_escape_string($conn, $_POST["user_name"]);
                $user_email = mysqli_real_escape_string($conn, $_POST["user_email"]);
                  $user_type_id = mysqli_real_escape_string($conn, $_POST["user_type_id"]);

                $user_password = mysqli_real_escape_string($conn, $_POST["user_password"]);

                $query_insert = mysqli_query($conn, "insert into tbl_users(`user_name`, `user_email`, `user_mobile`,user_type_id,`user_password`) VALUES ('{$user_name}','{$user_email}','{$user_mobile}','{$user_type_id}','{$user_password}')")or die(mysqli_error($conn));

                //success query run
                if ($query_insert) {
                    $response["flag"] = '1';
                    $response["message"] = "Your Record Inserted Successfully";
                } else {
                    $response["flag"] = '0';
                    $response["message"] = "Your Record Not Inserted";
                }
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