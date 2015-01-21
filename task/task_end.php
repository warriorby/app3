<?php
require("../include/conn.php");
require("../include/get_data.php");

$tid = $arr['tid'];
$uid = $arr['uid'];
$end_time = $arr['end_time'];
$task_status = $arr['task_status'];
$cost_time = $arr['cost_time'];
$rest_time = $arr['rest_time'];
if (isset($tid) && isset($uid) && isset($cost_time)) {
    $d2b->update("task_main",["uid"=>$uid,"task_status"=>$task_status,"end_time"=>$end_time,"cost_time"=>$cost_time,"rest_time"=>$rest_time],
    ["tid"=>$tid]);

    $integral = ceil($cost_time/10);
    $d2b->update("user_main",["integral[+]"=>$integral],["uid"=>$uid]);

    $return_arr = array("uid" => $uid, "tid" => $tid, "end_time" => $end_time, "cost_time" => $cost_time, "rest_time" => $rest_time);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}