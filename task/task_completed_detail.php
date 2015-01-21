<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$tid = $arr['tid'];
$role = $arr['role'];
if (isset($uid) && isset($tid) && isset($role)) {
    $rs_arr = $d2b->select("task_main", ["name_type_id", "cost_time", "rest_time", "comment", "star_level"], ["AND" => ["uid" => $uid, "tid" => $tid]]);
    $real_time = $rs_arr[0]['cost_time'];
    $rest_time = $rs_arr[0]['rest_time'];
    $comment = $rs_arr[0]['comment'];
    $star_level = $rs_arr[0]['star_level'];
    $name_type_id = $rs_arr[0]['name_type_id'];

    $rs_arr2 = $d2b->select("task_profile", ["task_name"], ["name_type_id" => $name_type_id]);
    $tname = $rs_arr2[0]['task_name'];

    $rs_arr3 = $d2b->select("task_picture", ["picture_start", "picture_end"], ["AND" => ["uid" => $uid, "tid" => $tid]]);
    $picture_start = $rs_arr3[0]['picture_start'];
    $picture_end = $rs_arr3[0]['picture_end'];

    $return_arr = array("uid" => $uid, "tid" => $tid, "cost_time" => $real_time, "rest_time" => $rest_time, "task_name" => $tname, "picture_start" => $picture_start, "picture_end" => $picture_end,
        "comment" => $comment, "star_level" => $star_level);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}