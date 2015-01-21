<?php
require("../include/conn.php");
require("../include/get_data.php");

$role = $arr['role'];
if (isset($role)) {
    switch ($role) {
        case 1:
            $uid_p = $arr['uid_p'];
            $rs_arr = $d2b->select("user_main", ["channelid"], ["uid" => $uid_p]);
            $channel_id = $rs_arr[0]['channelid'];
            $return_arr = array("uid_p" => $uid_p, "channelid" => $channel_id);
            include("../include/return_data.php");
            break;
        case 2:
            $uid_c = $arr['uid_c'];
            $rs_arr = $d2b->select("user_main", ["channelid"], ["uid" => $uid_c]);
            $channel_id = $rs_arr[0]['channelid'];
            $return_arr = array("uid_c" => $uid_c, "channelid" => $channel_id);
            include("../include/return_data.php");
            break;
        default:
            echo json_encode(0);
            break;
    }
} else {
    echo json_encode(0);
}


