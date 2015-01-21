<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
$award = $arr['award'];
$factor = $arr['factor'];

if (isset($uid) && isset($award) && isset($factor)) {
    $timestamp = time();
    $aid = $d2b->insert("task_award", ["uid" => $uid, "award" => $award, "factor" => $factor, "status" => 1, "updated" => $timestamp]);
    $return_arr = array("uid" => $uid, "award_id" => $aid, "status" => 1);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
