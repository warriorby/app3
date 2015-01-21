<?php
require("../include/conn.php");
require("../include/get_data.php");

$tid = $arr['tid'];
$uid = $arr['uid'];
$name_type_id = $arr['name_type_id'];
$plan_time = $arr['plan_time'];
$is_remind = $arr['needRemind'];
$photo_status = $arr['needPhoto'];
$add_time = $arr['end_time'];

if (isset($tid) && isset($uid)) {
    $d2b->update("task_main",["task_status"=>1,"start_time"=>0,"rest_time"=>0,"cost_time"=>0,"end_time"=>0],["tid"=>$tid]);
    $d2b->update("task_picture",["picture_start"=>null,"picture_end"=>null],["AND"=>["tid"=>$tid,"uid"=>$uid]]);
    $d2b->delete("task_log",["AND"=>["tid"=>$tid,"uid"=>$uid]]);

    $tid1 = $d2b->insert("task_main",["uid"=>$uid,"name_type_id"=>$name_type_id,"plan_time"=>$plan_time,"needRemind"=>$is_remind,"add_time"=>$add_time,
    "needPhoto"=>$photo_status,"task_status"=>4]);

    $return_arr = array("uid" => $uid, "tid" => $tid1);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}

