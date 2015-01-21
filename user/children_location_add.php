<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$position_x = $arr['position_x'];
$position_y = $arr['position_y'];

if (isset($uid) && isset($position_x) && isset($position_y)) {
    $timestamp = time();
    $d2b->update("user_location_log",["position_y"=>$position_y,"position_x"=>$position_x,"updated"=>$timestamp],["uid"=>$uid]);
    $return_arr = array("uid" => $uid);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
