<?php
require "../include/conn.php";
include "../include/get_data.php";

$uid =$arr['uid'];
$aid = $arr['award_id'];
$factor = $arr['factor'];
if(isset($uid) && isset($aid)){
    $timestamp = time();
    $d2b->update("task_award",["status"=>3,"updated"=>$timestamp],["AND"=>["uid"=>$uid,"award_id"=>$aid]]);
    $rs_arr = $d2b->select("user_relation",["uid_c"],["to_uid"=>$uid]);
    $uid_c = $rs_arr[0]['uid_c'];
    $d2b->update("user_main",["integral[-]"=>$factor],["uid"=>$uid_c]);
    $rs2_arr = $d2b->select("user_main",["integral"],["uid"=>$uid_c]);
    $integral = $rs2_arr[0]['integral'];
    if($integral < 0){
        $d2b->update("user_main",["integral"=>0],["uid"=>$uid_c]);
    }
    $return_arr = ["uid"=>$uid,"award_id"=>$aid];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}