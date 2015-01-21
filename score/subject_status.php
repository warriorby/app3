<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
$sub_id = $arr['sub_id'];

if (isset($uid) && isset($sub_id)) {
    $d2b->update("score_profile", ["status" => 2], ["sub_id" => $sub_id]);
    $return_arr = ["uid" => $uid, "sub_id" => $sub_id];
} else {
    echo json_encode(0);
}