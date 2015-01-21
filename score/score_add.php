<?php
require("../include/conn.php");
require("../include/get_data.php");
$uid = $arr['uid'];
$sub_id = $arr['sub_id'];
$score = $arr['score'];
$average = $arr['average'];
$total = $arr['total'];
$exam_date = $arr['exam_date'];

if (isset($uid) && isset($score) && isset($sub_id) && isset($average) && isset($total) && isset($exam_date)) {
    $timestamp = time();
    $score_id = $d2b->insert("score_main",["sub_id"=>$sub_id,"uid"=>$uid,"score"=>$score,"average"=>$average,"total"=>$total,"exam_date"=>$exam_date,
    "updated"=>$timestamp]);
    $return_arr = ["uid" => $uid, "score_id" => $score_id,"sub_id"=>$sub_id,"score"=>$score,"average"=>$average,"total"=>$total,"exam_data"=>$exam_date,
                    "updated"=>$timestamp];
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
