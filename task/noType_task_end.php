<?php
require("../include/conn.php");
require("../include/get_data.php");

$task_name = $arr['task_name'];
$task_type=$arr['task_type'];
$tid = $arr['tid'];
$uid = $arr['uid'];
$start_time = $arr['start_time'];
$end_time = $arr['end_time'];
$task_status = $arr['task_status'];
$cost_time = $arr['cost_time'];
$rest_time = $arr['rest_time'];
if (isset($tid) && isset($uid) && isset($cost_time) && isset($task_name) && isset($task_type)) {
    $rs_arr = $d2b->select("task_profile",["name_type_id"],["AND"=>["task_type"=>$task_type,"task_name"=>$task_name]]);
    if(count($rs_arr) == 0){
        $name_type_id = $d2b->insert("task_profile",["task_name"=>$task_name,"task_type"=>$task_type]);
    }else{
        $name_type_id = $rs_arr[0]['name_type_id'];
    }
    $d2b->update("task_main",["task_status"=>$task_status,"start_time"=>$start_time,"end_time"=>$end_time,"cost_time"=>$cost_time,"rest_time"=>$rest_time,"name_type_id"=>$name_type_id,"task_name"=>$task_name],
        ["AND"=>["tid"=>$tid,"uid"=>$uid]]);
    $gold = ceil($cost_time/10);
    $d2b->update("user_main",["integral[+]"=>$gold],["uid"=>$uid]);

    $return_arr = array("uid" => $uid, "tid" => $tid,"start_time"=>$start_time, "end_time" => $end_time, "cost_time" => $cost_time, "rest_time" => $rest_time);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}