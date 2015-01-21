<?php
require "../include/conn.php";
include "../include/get_data.php";

$uid =$arr['uid'];
$aid = $arr['award_id'];
if(isset($uid) && isset($aid)){
    $timestamp = time();
    $rs_arr = $d2b->select("user_relation",["to_uid"],["uid_c"=>$uid]);
    $uid_p = $rs_arr[0]['to_uid'];
    $d2b->update("task_award",["status"=>2,"updated"=>$timestamp],["AND"=>["uid"=>$uid_p,"award_id"=>$aid]]);
    $return_arr = ["uid"=>$uid,"award_id"=>$aid];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}