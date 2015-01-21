<?php
require("../include/conn.php");
require("../include/get_data.php");

$task_name = $arr['task_name'];
$uid = $arr['uid'];
$role = $arr['role'];
if (isset($uid) && isset($task_name) && isset($role)) {
    $timestamp = time();
    $tid = $d2b->insert("task_main", ["uid" => $uid, "task_name" => $task_name,
        "add_time" => $timestamp, "task_status" => 1,"role"=>$role]);

    $d2b->insert("task_log",["tid"=>$tid,"uid"=>$uid,"descr"=>"添加任务","updated"=>$timestamp,"role"=>$role]);
    $return_arr = array("uid" => $uid, "tid" => $tid);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}