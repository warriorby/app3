<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
if (isset($uid)) {
    $datas = $d2b->select("user_location_log","*",["uid"=>$uid]);
    $position_x = $datas[0]['position_x'];
    $position_y = $datas[0]['position_y'];
    $times = $datas[0]['updated'];

    $return_arr = array("uid" => $uid,"position_x"=>$position_x,"position_y"=>$position_y,"updated"=>$times);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
