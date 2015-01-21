<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$tid = $arr['tid'];
$photo_status = $arr['needPhoto'];
$img_new_name = $arr['picture_end'];

if (isset($uid) && isset($tid) && isset($photo_status) && isset($img_new_name)) {
    $timestamp = time();
    switch ($photo_status) {
        case 2:
            $d2b->update("task_picture",["picture_end"=>$img_new_name,"updated"=>$timestamp],["AND"=>["tid"=>$tid,"uid"=>$uid]]);
            break;
        case 3:
            $d2b->update("task_picture",["picture_end"=>$img_new_name,"updated"=>$timestamp],["AND"=>["tid"=>$tid,"uid"=>$uid]]);
            break;
        default:
            echo json_encode(0);
            break;
    }
    $return_arr = array("uid" => $uid, "tid" => $tid, "picture_end" => $img_new_name,"needPhoto"=>$photo_status);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}




