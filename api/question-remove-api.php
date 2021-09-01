<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

    //required field condition check
      if ((isset($_POST["is_remove"]) && (!empty($_POST["user_id"])) && (!empty($_POST["question_id"])))) {
    //if ((isset($_POST["is_remove"]) && isset($_POST["user_id"]) && isset($_POST["question_id"]))) {

        //blank field condition check
        if ($_POST["is_remove"] != '') {
            $is_remove = mysqli_real_escape_string($conn, $_POST["is_remove"]);
            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            $question_id = mysqli_real_escape_string($conn, $_POST["question_id"]);
            $today_datetime = today_datetime();
            $query_insert = mysqli_query($conn, "insert into tbl_remove_user_question(`question_id`, `user_id`, `is_remove`,`insert_datetime`) VALUES ('{$question_id}','{$user_id}','{$is_remove}','{$today_datetime}')")or die(mysqli_error($conn));
            if ($query_insert) {
                
                // is_remove 1  then insert 1 remove count insert
                $getque = mysqli_query($conn, "select * from tbl_questions where question_id='{$row['question_id']}'") or die(mysqli_error($conn));
                $querow = mysqli_fetch_array($getque);
                if ($is_remove == 1) { 
                    $remove_count = ($querow['remove_count'] + 1);
                     $querycontactupdate = mysqli_query($conn,"UPDATE `tbl_questions` SET `remove_count`='$remove_count' WHERE question_id='{$question_id}'") or die(mysqli_error($conn));
                    $response["flag"] = '1';
                    $response["message"] = "Question Removed Successfully";
                } else {
                    // is_remove 1 then insert 0 pass count insert
                    $pass_count = ($querow['pass_count'] + 1);
                     $querycontactupdate = mysqli_query($conn,"UPDATE `tbl_questions` SET `pass_count`='$pass_count' WHERE question_id='{$question_id}'") or die(mysqli_error($conn));
                    $response["flag"] = '1';
                    $response["message"] = "Question Passed Successfully";
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