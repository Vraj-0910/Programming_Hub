<?php

require '../class/connection.php';

//authentication check token name and token value
if ($_SERVER['PHP_AUTH_USER'] == $GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW'] == $GLOBALS['tokenvalue']) {
    $response = array();
    if (isset($_POST["term"]) && !empty($_POST["user_id"]) && (isset($_POST["blog_id"]))) {
        $term = mysqli_real_escape_string($conn, $_POST["term"]);
        $userid = mysqli_real_escape_string($conn, $_POST["user_id"]);
        $blogid = mysqli_real_escape_string($conn, $_POST["blog_id"]);
        
        
         if ($term != '') {
            $search = "and blog_title Like '%$term%'";
         }
         else{
             $search = '';
         }
         
          if ($blogid != '') {
              $search_blog_id = "and blog_id = '$blogid'";
          }
          else{
              $search_blog_id ='';
          }
        
        
          
                  $query_blog_1 = mysqli_query($conn, "select * from tbl_blog where  is_delete='0' and user_id != '$userid' and is_active='1' $search $search_blog_id order by blog_id DESC") or die(mysqli_error($conn));

        
            //pagination start
        
             $numrows = mysqli_num_rows($query_blog_1);

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
          
          
        
                  $query_blog_listing = mysqli_query($conn, "select * from tbl_blog where  is_delete='0' and user_id != '$userid' and is_active='1' $search $search_blog_id order by blog_id DESC  limit $offset, $rowsperpage") or die(mysqli_error($conn));
        
              //this condition check current page less then qual total page or totalpage qual to 0
                if ($currentpage <= $totalpages || $totalpages == 0) {
        $count = mysqli_num_rows($query_blog_listing);
                
        //this condition check usertype data is greater than 0
        if ($count > 0) {

            $response["flag"] = "1";
            $response["message"] = "$count Record Found";

            $response["blog"] = array();
            while ($row = mysqli_fetch_array($query_blog_listing)) {

                
                 $removeq = mysqli_query($conn, "select * from tbl_blog_remove where user_id='{$userid}' and blog_id='{$row['blog_id']}' and is_remove='1'") or die(mysqli_error($conn));
            
            $countanremove = mysqli_num_rows($removeq);
            if($countanremove > 0){
				$response["flag"] = "0";
//				 $response["message"] = "You're all caught up. No questions are available for you at the moment";
                //$response["question"] = "You're all caught up. No questions are available for you at the moment";
            }
            else{
                
                $userq = mysqli_query($conn, "select * from tbl_users where user_id='{$row['user_id']}' and is_delete='0' and is_active='1'") or die(mysqli_error($conn));
                $getuser = mysqli_fetch_array($userq);
                $details = $row["blog_details"];
                $out = strlen($details) > 50 ? substr($details, 0, 50) . "..." : $details;
                $temparray = array();
                $temparray["blog_id"] = $row["blog_id"];
                $temparray["user_name"] = $getuser["user_name"];
                
              //    $temparray["user_name_title "] = $getuser["user_name"].' • '.relative_time($row['insert_datetime']);
                
                $temparray["blog_title"] = $row["blog_title"];
                $temparray["blog_details"] = $out;
                $temparray["blog_img"] = base_url() . "upload/blog/" . $row["blog_img"];
                $temparray["added_ago"] = "Added • ".relative_time($row['insert_datetime']);
              
              
                $temparray["blog_recommendation"] = "This Blog is Recommended For You";
                
                if($row["upvote"] =='0' && $row["downvote"] =='0')
                {
                $is_upvote = "2";    
                }
                else{
                    $is_upvote = $row["is_upvote"];    
                }
                
                //$temparray["is_upvote"] = $row["is_upvote"];
                $temparray["is_upvote"] = $is_upvote;
                
                if($row["upvote"] =='0')
            {
                $upvoate =   "No upvote";
            }
            else{
                $upvoate =   $row["upvote"]." upvote";
            }
                  $temparray["upvote"] = $upvoate;
                  
                    if($row["downvote"] =='0')
            {
                $downvote =   "No downvote";
            }
            else{
                $downvote =   $row["downvote"]." downvote";
            }
                    $temparray["downvote"] = $downvote;
                
                
                   $title = $getuser["user_name"];
                $user_name_initials = ucfirst(mb_substr($title, 0, 1));
                
                 if($user_name_initials == '.')
               {
                   $user_name_initials = ucfirst(mb_substr($title, 1, 1));
               }
                
                
             //  $response["user_name_type_initials"] = $user_name_initials;
  $temparray["user_name_initials"] = $user_name_initials;
                
            

                array_push($response["blog"], $temparray);
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