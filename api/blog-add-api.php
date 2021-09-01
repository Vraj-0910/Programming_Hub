<?php

require '../class/connection.php';

//authentication check token name and token value
//if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {

    $response = array();

    //required field condition check
    if ((isset($_POST["user_id"])) && isset($_POST["blog_title"]) && isset($_POST["blog_details"]) && isset($_FILES["blog_img"])) {

        //blank field condition check
        if ($_POST["user_id"] != '' && $_POST["blog_title"] != '' && $_POST["blog_details"] != '' && $_FILES["blog_img"] != '') {

            $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
            $blog_title = mysqli_real_escape_string($conn, $_POST["blog_title"]);
            $blog_details = mysqli_real_escape_string($conn, $_POST["blog_details"]);
            $today_datetime = today_datetime();

            
                  //folder insert productimage
   $cphoto = $_FILES['blog_img']['name'];
//     $path = 'clientlogo/';
   //$path = base_url()."upload/blog/";
   $path = "../upload/blog/";
   $time = time();
   $destination = $path.$time.basename($cphoto);
   
      
   
 
   move_uploaded_file($_FILES['blog_img']['tmp_name'], $destination);
             //database insert img name
    $cimg = $time.basename($cphoto);  
            
            
            $query_insert = mysqli_query($conn, "INSERT INTO `tbl_blog`(`user_id`, `blog_title`, `blog_details`,`blog_img`,`insert_datetime`) VALUES ('{$user_id}','{$blog_title}','{$blog_details}','{$cimg}','{$today_datetime}')")or die(mysqli_error($conn));
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
//} else {

//    header('WWW-Authenticate: Basic realm="My Realm"');
//    header('HTTP/1.0 401 Unauthorized');
//    $response["flag"] = "0";
//    $response['message'] = 'Sorry You Are not Allow to access';
//}

echo json_encode($response);
?>

