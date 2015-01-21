<?php
require("../include/conn.php");
require("../include/get_data.php");

$uname = $arr['uname'];
$real_name = $arr['real_name_c'];
$zid = $arr['zid'];
$sid = $arr['sid'];
$gid = $arr['gid'];
$class_id = $arr['class_id'];
$role = $arr['role'];

//$local_group_id = $cid.$zid.$sid.$gid.$class_id.$enter_year;

if (isset($zid) && isset($sid) && isset($gid) && isset($class_id)) {
    switch ($role) {
        case 1:
            $uid_p = $arr['uid_p'];
            $to_groupGid = $arr['to_groupGid'];
            $to_groupClassId = $arr['to_groupClassId'];
            $d2b->update("im_group", ["to_group_id" => $to_groupGid], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => "00"]]);
            $d2b->update("im_group", ["to_group_id" => $to_groupClassId], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => $class_id]]);
            $d2b->update("user_im_group", ["group_gid" => $to_groupGid, "group_classid" => $to_groupClassId], ["AND" => ["uid" => $uid_p, "role" => $role]]);
            $return_arr = array("uid_p" => $uid_p, "to_groupGid" => $to_groupGid, "to_groupClassId" => $to_groupClassId);
            break;
        case 2:
            $uid_c = $arr['uid_c'];
            $group_gid = $arr['group_gid'];
            $group_class_id = $arr['group_classid'];
            $d2b->update("im_group", ["group_id" => $group_gid], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => "00"]]);
            $d2b->update("im_group", ["group_id" => $group_class_id], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => $class_id]]);
            $d2b->update("user_im_group", ["group_gid" => $group_gid, "group_classid" => $group_class_id], ["AND" => ["uid" => $uid_c, "role" => $role]]);
            $return_arr = array("uid_c" => $uid_c, "group_gid" => $group_gid, "group_classid" => $group_class_id);
            break;
        default:
            echo json_encode(0);
            break;
    }
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}

