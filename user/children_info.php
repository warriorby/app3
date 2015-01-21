<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];

if (isset($uid)) {
    $rs_arr = $d2b->select("user_avatar", ["avatar"], ["uid" => $uid]);
    $avatar = $rs_arr[0]['avatar'];

    $rs_arr2 = $d2b->select("user_profile", ["real_name"], ["uid" => $uid]);
    $real_name = $rs_arr2[0]['real_name'];

    $rs_arr3 = $d2b->select("user_profile", ["sid", "gid", "class_id"], ["uid" => $uid]);
    $sid = $rs_arr3[0]['sid'];
    $gid = $rs_arr3[0]['gid'];
    $classid = $rs_arr3[0]['class_id'];

    $return_arr = array("uid" => $uid, "avatar" => $avatar, "real_name" => $real_name, "sid" => $sid, "gid" => $gid, "class_id" => $classid);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
