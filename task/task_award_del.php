<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
$award_id = $arr['award_id'];

if (isset($uid) && isset($award_id)) {
    $timestamp = time();
    $d2b->delete("task_award", ["AND"=>["uid" => $uid, "award_id" => $award_id]]);
    $return_arr = array("uid" => $uid, "award_id" => $award_id);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
