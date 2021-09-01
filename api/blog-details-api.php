<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    $response = array();
    if ((!empty($_POST["blog_id"]))) {

        $blogid = mysqli_real_escape_string($conn, $_POST["blog_id"]);

        $query_user_type = mysqli_query($conn, "select * from tbl_blog where  is_delete='0' and blog_id = '$blogid' and is_active='1' order by blog_id DESC") or die(mysqli_error($conn));

            $response["flag"] = "1";
            $response["message"] = "Blog Details";

            $response["blog"] = array();
            while ($row = mysqli_fetch_array($query_user_type)) {

                $userq = mysqli_query($conn, "select * from tbl_users where user_id='{$row['user_id']}' and is_delete='0' and is_active='1'") or die(mysqli_error($conn));
                $getuser = mysqli_fetch_array($userq);
                $details = $row["blog_details"];
                
                $temparray = array();
                $temparray["blog_id"] = $row["blog_id"];
                $temparray["user_name"] = $getuser["user_name"];
                $temparray["blog_title"] = $row["blog_title"];
                $temparray["blog_details"] = $details;
                $temparray["blog_img"] = base_url() . "upload/blog/" . $row["blog_img"];
                $temparray["added_ago"] = relative_time($row['insert_datetime']);
                $temparray["upvote"] = $row["upvote"];
                $temparray["downvote"] = $row["downvote"];


                array_push($response["blog"], $temparray);
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