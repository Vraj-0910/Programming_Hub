<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    $response = array();
    if ((!empty($_POST["blog_id"])) && (isset($_POST["upvote"])) && (!empty($_POST["user_id"]))) {

        $blogid = mysqli_real_escape_string($conn, $_POST["blog_id"]);
        $upvote = mysqli_real_escape_string($conn, $_POST["upvote"]);
         $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
              $today_datetime=today_datetime();
        $query_user_type = mysqli_query($conn, "select * from tbl_blog where  is_delete='0' and blog_id = '$blogid' and is_active='1' order by blog_id DESC") or die(mysqli_error($conn));
        $row = mysqli_fetch_array($query_user_type);

        
        //note upvote o then downvote insert  0 is_upvote_downvote
         // and upvote 1 then upvote insert 1 is_upvote_downvote
        if ($upvote == 0) {
            
            
            
            //query downvote insert in tbl_blog_action
              $query_blog_count = mysqli_query($conn,"SELECT * FROM `tbl_blog_action` where blog_id='{$blogid}' and  user_id='$user_id' and is_upvote_downvote='0'")or die(mysqli_error($conn));
                $count_blog = mysqli_num_rows($query_blog_count);
                if($count_blog >0)
                {
                    
                }
            else{
            $query_downvote_insert = mysqli_query($conn, "INSERT INTO `tbl_blog_action`(`blog_id`, `user_id`, `is_upvote_downvote`,`insert_datetime`) VALUES ('{$blogid}','{$user_id}','0','{$today_datetime}')") or die(mysqli_error($conn));
            
            $downvote = ($row['downvote'] + 1);
            $querycontactupdate = mysqli_query($conn, "UPDATE `tbl_blog` SET `downvote`='$downvote',is_upvote='0' WHERE blog_id='{$blogid}'") or die(mysqli_error($conn));
            }
            $response["flag"] = '1';
        $response["message"] = "Blog Downvote Successfully";
            
            } else {
                
                 
                $query_blog_count = mysqli_query($conn,"SELECT * FROM `tbl_blog_action` where blog_id='{$blogid}' and  user_id='$user_id' and is_upvote_downvote='1'")or die(mysqli_error($conn));
                $count_blog = mysqli_num_rows($query_blog_count);
                if($count_blog >0)
                {
                    
                }
                else{
                $query_upvote_insert = mysqli_query($conn, "INSERT INTO `tbl_blog_action`(`blog_id`, `user_id`, `is_upvote_downvote`,`insert_datetime`) VALUES ('{$blogid}','{$user_id}','1','{$today_datetime}')") or die(mysqli_error($conn));
                
            $upvote = ($row['upvote'] + 1);
            $querycontactupdate = mysqli_query($conn, "UPDATE `tbl_blog` SET `upvote`='$upvote',is_upvote='1' WHERE blog_id='{$blogid}'") or die(mysqli_error($conn));
                }
            $response["flag"] = '1';
         $response["message"] = "Blog Upvote Successfully";
            
            }
    } else {
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