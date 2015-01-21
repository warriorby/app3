<?php
require("../include/conn.php");
require("../include/get_data.php");
$uid = $arr['uid'];
$avatar = $arr['avatar'];

if (isset($uid) && isset($avatar)) {
    $timestamp = time();
    $d2b->insert("user_avatar",["uid"=>$uid,"avatar"=>$avatar,"updated"=>$timestamp]);

    $return_arr = array("uid" => $uid, "avatar" => $avatar);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}



