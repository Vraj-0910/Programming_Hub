<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

    //required field condition check
    if ((isset($_POST["question_id"])) && isset($_POST["user_id"]) && isset($_POST["question_answer"])) {

        //blank field condition check
        if ($_POST["question_id"] != '' && $_POST["user_id"] != '' && $_POST["question_answer"] != '') {

            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            $question_id = mysqli_real_escape_string($conn, $_POST["question_id"]);
            $question_answer = mysqli_real_escape_string($conn, $_POST["question_answer"]);
            $today_datetime = today_datetime();

            $query_insert = mysqli_query($conn, "INSERT INTO `tbl_answer`(`question_id`, `user_id`, `question_answer`,`insert_datetime`) VALUES ('{$question_id}','{$user_id}','{$question_answer}','{$today_datetime}')")or die(mysqli_error($conn));
            //success query run
            if ($query_insert) {



                $response["flag"] = '1';
                $response["message"] = "Your Record Inserted Successfully";


                $last_id = mysqli_insert_id($conn);
                $response["question_answer"] = array();
                $temparray = array();
                $query_answer = mysqli_query($conn, "select * from tbl_answer where answer_id='{$last_id}'") or die(mysqli_error($conn));

                $row_answer = mysqli_fetch_array($query_answer);


                                $query_question = mysqli_query($conn, "select * from tbl_questions where question_id='{$row_answer["question_id"]}'") or die(mysqli_error($conn));

                $row_question = mysqli_fetch_array($query_question);
                
                $temparray["question_id"] = $row_answer["question_id"];
                $temparray["answer_id"] = $row_answer["answer_id"];
                $temparray["user_id"] = $row_answer["user_id"];
                $temparray["question"] = $row_question["question"];
                $temparray["question_answer"] = $row_answer["question_answer"];
                array_push($response["question_answer"], $temparray);
                //      $response["answer_id"] = $row_answer["answer_id"];
            } else {
                $response["flag"] = '0';
                $response["message"] = "Your Record Not Inserted";
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

