<?php
require("../include/conn.php");
require("../include/get_data.php");

$phone = $arr['phone'];
$pwd = $arr['password'];
$login_type = $arr['login_type'];
$channel_id = $arr['channelid'];
$role = $arr['role'];
if (isset($phone) && isset($role) && isset($pwd)) {
    $rs_arr = $d2b->select("user_main", ["password", "uid"], ["AND" => ["phone" => $phone, "role" => $role]]);
    $password = $rs_arr[0]['password'];
    $pwd = hash("sha256", $pwd);
    if ($password == $pwd) {
        switch ($login_type) {
            case 2:
                $uid_p = $rs_arr[0]['uid'];
                $timestamp = time();
                $d2b->update("user_main", ["last_login" => $timestamp, "channelid" => $channel_id], ["uid" => $uid_p]);

                $rs2_arr = $d2b->select("user_main", ["phone"], ["uid" => $uid_p]);
                // $uname = $rs2_arr[0]['uname'];
                $phone = $rs2_arr[0]['phone'];

                $rs3_arr = $d2b->select("user_profile", ["real_name", "sex","rel"], ["uid" => $uid_p]);
                $real_name_p = $rs3_arr[0]['real_name'];
                $sex_p = $rs3_arr[0]['sex'];
                $rel = $rs3_arr[0]['rel'];
                if ($sex_p == null) {
                    $sex_p = 2;
                }

                $rs5_arr = $d2b->select("user_relation", ["uid_c"], ["to_uid" => $uid_p]);
                $uid_c = $rs5_arr[0]['uid_c'];
                $rs8_arr = $d2b->select("user_profile", ["real_name", "sex","birth"], ["uid" => $uid_c]);
                $real_name_c = $rs8_arr[0]['real_name'];
                $sex_c = $rs8_arr[0]['sex'];
                $birth = $rs8_arr[0]['birth'];
                if ($sex_c == null) {
                    $sex_c = 2;
                }

                $rs6_arr = $d2b->select("user_main", ["channelid"], ["uid" => $uid_c]);
                $channelid_c = $rs6_arr[0]['channelid'];

                $rs7_arr = $d2b->select("user_education", ["zid", "sid", "gid", "class_id"], ["uid" => $uid_c]);
                $zid = $rs7_arr[0]['zid'];
                $sid = $rs7_arr[0]['sid'];
                $gid = $rs7_arr[0]['gid'];
                $class_id = $rs7_arr[0]['class_id'];
                if ($class_id == null) {
                    $to_groupGid = '';
                    $to_groupClassId = '';
                } else {
                    include "parent_imReg.php";
                }
                $return_arr = array('uid_p' => $uid_p, 'phone' => $phone, 'role' => $role, 'real_name_p' => $real_name_p, "real_name_c" => $real_name_c, "channelid" => $channelid_c,
                    "uid_c" => $uid_c, "to_groupGid" => $to_groupGid, "to_groupClassId" => $to_groupClassId,"birth"=>$birth,"rel"=>$rel,
                    'zid' => $zid, 'sid' => $sid, 'gid' => $gid, 'class_id' => $class_id, "sex_p" => $sex_p, "sex_c" => $sex_c);
                include("../include/return_data.php");
                break;
            case 1:
                $uid_c = $rs_arr[0]['uid'];
                $timestamp = time();
                $d2b->update("user_main", ["last_login" => $timestamp, "channelid" => $channel_id], ["uid" => $uid_c]);

                $rs2_arr = $d2b->select("user_main", ["phone"], ["uid" => $uid_c]);
                $phone = $rs2_arr[0]['phone'];

                $rs3_arr = $d2b->select("user_profile", ["birth", "sex", "real_name"], ["uid" => $uid_c]);
                $real_name_c = $rs3_arr[0]['real_name'];
                $birth = $rs3_arr[0]['birth'];
                $sex_c = $rs3_arr[0]['sex'];

                $rs4_arr = $d2b->select("user_education", ["pid", "cid", "zid", "sid", "gid", "class_id"], ["uid" => $uid_c]);
                $pid = $rs4_arr[0]['pid'];
                $cid = $rs4_arr[0]['cid'];
                $zid = $rs4_arr[0]['zid'];
                $sid = $rs4_arr[0]['sid'];
                $gid = $rs4_arr[0]['gid'];
                $class_id = $rs4_arr[0]['class_id'];
                if ($class_id == null) {
                    $group_gid = '';
                    $group_classId = '';
                } else {
                    include "chilren_imReg.php";
                }
                $rs5_arr = $d2b->select("user_relation", ["to_uid"], ["uid_c" => $uid_c]);
                $uid_p = $rs5_arr[0]['to_uid'];
                if ($uid_p == 0) {
                    $sex_p = 1;
                } else {
                    $rs6_arr = $d2b->select("user_profile", ["sex"], ["uid" => $uid_p]);
                    $sex_p = $rs6_arr[0]['sex'];
                }
                $return_arr = array('uid_c' => $uid_c, "uid_p" => $uid_p, 'phone' => $phone, 'role' => $role, 'real_name_c' => $real_name_c, "zid" => $zid,
                    'sid' => $sid, 'gid' => $gid, 'class_id' => $class_id, 'group_gid' => $group_gid, 'group_classid' => $group_classId, "channelid" => $channel_id,
                    'sex_c' => $sex_c, 'sex_p' => $sex_p, "birth" => $birth, "pid" => $pid, "cid" => $cid);
                include("../include/return_data.php");
                break;
            default:
                echo json_encode(0);
                break;
        }
    } else {
        echo json_encode(-103);
    }
} else {
    echo json_encode(0);
}