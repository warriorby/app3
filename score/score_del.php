<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$sub_id = $arr['sub_id'];
$score_id = $arr['score_id'];

if (isset($uid) && isset($sub_id) && isset($score_id)) {
    $d2b->delete("score_main",["AND"=>["uid"=>$uid,"sub_id"=>$sub_id,"score_id"=>$score_id]]);
    $return_arr = ["uid" => $uid];
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}