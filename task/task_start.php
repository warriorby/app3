<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$tid = $arr['tid'];
$start_time = $arr['start_time'];
$task_status = $arr['task_status'];
if (isset($uid) && isset($tid)) {
    $d2b->update("task_main",["uid"=>$uid,"start_time"=>$start_time,"task_status"=>$task_status],["tid"=>$tid]);
    $return_arr = array("uid" => $uid, "tid" => $tid, "start_time" => $start_time);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
