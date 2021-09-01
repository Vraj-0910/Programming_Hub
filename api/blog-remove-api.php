<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

  
    //required field condition check
    if ((isset($_POST["is_remove"]) && (!empty($_POST["user_id"])) && (!empty($_POST["blog_id"])))) {

        //blank field condition check
        if ($_POST["is_remove"] != '') {
            $is_remove = mysqli_real_escape_string($conn, $_POST["is_remove"]);
            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            $blog_id = mysqli_real_escape_string($conn, $_POST["blog_id"]);
            $today_datetime = today_datetime();
            
            //query blog_remove insert data
            $query_insert = mysqli_query($conn, "insert into tbl_blog_remove(`blog_id`, `user_id`, `is_remove`,`insert_datetime`) VALUES ('{$blog_id}','{$user_id}','{$is_remove}','{$today_datetime}')")or die(mysqli_error($conn));
            if ($query_insert) {
                //query get blog one record
                $getque = mysqli_query($conn, "select * from tbl_blog where blog_id='{$blog_id}'") or die(mysqli_error($conn));
                $querow = mysqli_fetch_array($getque);
                
                //note is_remove 1 then update blog  remove_count 1
                if ($is_remove == 1) { 
                    $remove_count = ($querow['remove_count'] + 1);
                     $query_blog_update = mysqli_query($conn,"UPDATE `tbl_blog` SET `remove_count`='$remove_count' WHERE blog_id='{$blog_id}'") or die(mysqli_error($conn));
                    $response["flag"] = '1';
                    $response["message"] = "Blog Removed Successfully";
                } else {
                    //note is_remove 1 then update blog  pass_count 1
                    $pass_count = ($querow['pass_count'] + 1);
                     $query_blog_update = mysqli_query($conn,"UPDATE `tbl_blog` SET `pass_count`='$pass_count' WHERE blog_id='{$blog_id}'") or die(mysqli_error($conn));
                    $response["flag"] = '1';
                    $response["message"] = "Blog Passed Successfully";
                }
            } else {
                $response["flag"] = '0';
                $response["message"] = "Please Try After Some Time";
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