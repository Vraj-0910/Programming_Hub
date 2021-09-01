<?php

 global $tokenname, $tokenvalue ;
 
 error_reporting(0);
 
 $conn = mysqli_connect("localhost","root","","programming_hub") or die("error");
 define('BASE_URL', 'http://192.168.0.3/programming_hub/');
//$con = mysqli_connect("localhost","apweb_falldetect","MAiy4-V~GYZK","apweb_falldetection") or die("error");

header('Access-Control-Allow-Origin: *');
$tokenname = 'programming_hub';
$tokenvalue = 'programming_hub@998';

function base_url() {
    return BASE_URL;
}

date_default_timezone_set('Asia/Calcutta');

function relative_time($data_in) {
    $start_date = new DateTime(date('Y-m-d h:i:s'));
    $since_start = $start_date->diff(new DateTime($data_in));
    $out = '';
    if (empty($out) && $since_start->y != 0)
        $out .= $since_start->y . ' years';
    else if (empty($out) && $since_start->m != 0)
        $out .= $since_start->m . ' months';
    else if (empty($out) && $since_start->d != 0)
        $out .= $since_start->d . ' days';
    else if (empty($out) && $since_start->h != 0)
        $out .= $since_start->h . ' hours';
    else if (empty($out) && $since_start->i != 0)
        $out .= $since_start->i . ' minutes';
    else if (empty($out) && $since_start->s != 0)
        $out .= $since_start->s . ' seconds';
    return $out . ' ago';
}

//this function will return todays date 
function today_date() {
    return date('Y-m-d');
}

//this function will return current time 
function today_time() {
    return date('h:i:s');
}

//this  function will return current time stamp
function today_datetime() {
    return date('Y-m-d h:i:s');
}

//this function will change the format of date and time 
//1st argument will be format
//2nd argument will be date 
function change_date_format($format, $date) {
    return date($format, strtotime($date));
}
?>