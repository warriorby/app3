<?php
require "../include/conn.php";
require "../include/get_data.php";

$tid = $arr['tid'];
$plan_time = $arr['plan_time'];
$is_remind = $arr['needRemind'];
$photo_status = $arr['needPhoto'];
$uid = $arr['uid'];

if(isset($uid) && isset($tid)){
    $d2b->update("task_main",["plan_time"=>$plan_time,"needRemind"=>$is_remind,"needPhoto"=>$photo_status],["AND"=>["uid"=>$uid,"tid"=>$tid]]);

    $return_arr = ["uid"=>$uid,"tid"=>$tid,"plan_time"=>$plan_time,"needRemind"=>$is_remind,"needPhoto"=>$photo_status];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}