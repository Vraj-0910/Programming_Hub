<?php
require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();
    
    //required field condition check
    if ((isset($_POST["user_id"])) && isset($_POST["question"])) {
    
         //blank field condition check
         if ($_POST["user_id"] != '' && $_POST["question"] != '') {
         
                     $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
                             $question = mysqli_real_escape_string($conn, $_POST["question"]);
                              $optional_link = mysqli_real_escape_string($conn, $_POST["optional_link"]);
                              $today_datetime = today_datetime();
                   
               $query_insert = mysqli_query($conn, "INSERT INTO `tbl_questions`(`user_id`, `question`, `optional_link`,`insert_datetime`) VALUES ('{$user_id}','{$question}','{$optional_link}','{$today_datetime}')")or die(mysqli_error($conn));               
              //success query run
                if ($query_insert) {
                    $response["flag"] = '1';
                    $response["message"] = "Your Record Inserted Successfully";
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

