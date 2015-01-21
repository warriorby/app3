<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$tid = $arr['tid'];
$photo_status = $arr['needPhoto'];
$img_new_name = $arr['picture_start'];

if (isset($uid) && isset($tid) && isset($photo_status) && isset($img_new_name)) {
    $timestamp = time();
    if ($photo_status = 1 || $photo_status = 3) {
        $d2b->update("task_picture", ["picture_start" => $img_new_name, "updated" => $timestamp], ["AND" => ["tid" => $tid, "uid" => $uid]]);

        $return_arr = array("uid" => $uid, "tid" => $tid, "picture_start" => $img_new_name, "needPhoto" => $photo_status);
        include("../include/return_data.php");
    } else {
        echo json_encode(0);
    }
} else {
    echo json_encode(0);
}



