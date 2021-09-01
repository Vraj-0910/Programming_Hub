<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    $response = array();
 if ((isset($_POST["term"]) && !empty($_POST["user_id"]))) {
     $term = mysqli_real_escape_string($conn, $_POST["term"]);
      $userid = mysqli_real_escape_string($conn, $_POST["user_id"]);
      
      
      
         //pagination query
        if ($term != '') {
            $query_user_type_1 = mysqli_query($conn, "select * from tbl_questions where question Like '%$term%' and user_id != '$userid' and is_delete='0' and is_active='1' order by question_id DESC") or die(mysqli_error($conn));
        } else {
            $query_user_type_1 = mysqli_query($conn, "select * from tbl_questions where  is_delete='0' and user_id != '$userid' and is_active='1' order by question_id DESC") or die(mysqli_error($conn));
        }
        
          //pagination start
        
             $numrows = mysqli_num_rows($query_user_type_1);

                $rowsperpage = 10;
                $totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
                if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
                    $currentpage = $_POST['currentpage'];
                } else {
                    $currentpage = 1;  // default page number
                }
// if current page is less than first page
                if ($currentpage <= 1) {
// set current page to first page
                    $currentpage = 1;
                }
                // the offset of the list, based on current page
                $offset = ($currentpage - 1) * $rowsperpage;
        
      
      
      //display data
                if ($term != '') {

            $query_user_type = mysqli_query($conn, "select * from tbl_questions where question Like '%$term%' and user_id != '$userid' and is_delete='0' and is_active='1' order by question_id DESC limit $offset, $rowsperpage") or die(mysqli_error($conn));
        } else {
            $query_user_type = mysqli_query($conn, "select * from tbl_questions where  is_delete='0' and user_id != '$userid' and is_active='1' order by question_id DESC limit $offset, $rowsperpage") or die(mysqli_error($conn));
        }
     
     
      //this condition check current page less then qual total page or totalpage qual to 0
                if ($currentpage <= $totalpages || $totalpages == 0) {
         $count = mysqli_num_rows($query_user_type);
    
    //this condition check usertype data is greater than 0
    if ($count > 0) {
       // $response["post"] = $_POST;
        $response["flag"] = "1";
        $response["message"] = "$count Record Found";
        
        $response["question"] = array();
        while ($row = mysqli_fetch_array($query_user_type)) {
            $removeq = mysqli_query($conn, "select * from tbl_remove_user_question where user_id='{$userid}' and question_id='{$row['question_id']}' and (is_remove = 1 or is_remove = 0)") or die(mysqli_error($conn));
            
            $countanremove = mysqli_num_rows($removeq);
            if($countanremove > 0){
//		$response["flag"] = "0";
//		$response["message"] = "You're all caught up. No questions are available for you at the moment";
                //$response["question"] = "You're all caught up. No questions are available for you at the moment";
            }else{
            $userq = mysqli_query($conn, "select * from tbl_users where user_id='{$row['user_id']}' and is_delete='0' and is_active='1'") or die(mysqli_error($conn));
            $getuser = mysqli_fetch_array($userq);
            
            $answerq = mysqli_query($conn, "select * from tbl_answer where user_id='{$row['user_id']}' and question_id = '{$row['question_id']}' and is_delete='0' and is_active='1'") or die(mysqli_error($conn));
            $countans = mysqli_num_rows($answerq);
            
            if($countans =='0')
            {
                $totalans =   "No Answers";
            }
            else{
            if($countans <= 1){
              $totalans =   $countans . ' Answer';
            }else{
                 $totalans =   $countans . ' Answers';
            }
            }
            $temparray = array();

            $temparray["question_id"] = $row["question_id"];
             //$temparray["user_name"] = $getuser["user_name"];
            $temparray["question"] = $row["question"];
            $temparray["optional_link"] = $row["optional_link"];
            $temparray["title"] = "Added by ".$getuser["user_name"].' • '.relative_time($row['insert_datetime']);
            $temparray["sub_title"] = $totalans;
            

            array_push($response["question"], $temparray);

            }
        }
    }
    //no record found
    else {
         
        $response["flag"] = "0";
        $response["message"] = "No Record Found";
    }
    
     } else {
                    $response["flag"] = "3";
                    $response["message"] = "Page End";
                }
 }
     else {
        $response["flag"] = '0';
        $response["message"] = "Required Field Is Missing";
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