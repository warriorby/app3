<?php
require("../include/conn.php");
require("../include/get_data.php");

$name_type_id = $arr['name_type_id'];
$plan_time = $arr['plan_time'];
$is_remind = $arr['needRemind'];
$photo_status = $arr['needPhoto'];
$uid = $arr['uid'];
$role = $arr['role'];
if (isset($uid) && isset($name_type_id)) {
    $timestamp = time();
    $tid = $d2b->insert("task_main", ["uid" => $uid, "name_type_id" => $name_type_id, "plan_time" => $plan_time, "needRemind" => $is_remind,
        "add_time" => $timestamp, "needPhoto" => $photo_status, "task_status" => 1,"role"=>$role]);

    $d2b->insert("task_picture",["tid"=>$tid,"uid"=>$uid,"updated"=>$timestamp,"role"=>$role]);
    $d2b->insert("task_log",["tid"=>$tid,"uid"=>$uid,"descr"=>"添加任务","updated"=>$timestamp,"role"=>$role]);

    $return_arr = array("uid" => $uid, "tid" => $tid);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
