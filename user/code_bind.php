<?php
require_once("../include/conn.php");
require_once("../include/get_data.php");

$uid_c = $arr['uid'];
$code_key = $arr['code_key'];
$channel_id = $arr['channelid'];
if (isset($uid_c)) {
    $data = $d2b->select("key_list",["uid_p"],["code_key"=>$code_key]);
    $uid_p = $data[0]['uid_p'];
    if ($uid_c == 0) {
        if (isset($uid_p)) {
            $rs_arr = $d2b->select("user_relation", ["uid_c"], ["to_uid" => $uid_p]);
            $uid_c = $rs_arr[0]['uid_c'];
            $rs2_arr = $d2b->select("user_main", ["phone", "password", "role"], ["uid" => $uid_c]);
            $phone = $rs2_arr[0]['phone'];
            $pwd = $rs2_arr[0]['password'];
            $role = $rs2_arr[0]['role'];
            //登录
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
        } else {
            echo json_encode(0);
        }
    } else {
        $rs_arr = $d2b->select("user_relation", ["to_uid"], ["uid_c" => $uid_c]);
        $uid2_p = $rs_arr[0]['to_uid'];
        if ($uid2_p == 0) {
            if (isset($uid_p)) {
                $d2b->update("user_relation", ["to_uid" => $uid_p,"relation"=>1], ["uid_c" => $uid_c]);
                $return_arr = ["uid_c" => $uid_c, "uid_p" => $uid_p];
            } else {
                echo json_encode(0);
            }
        } else {
            $return_arr = ["uid_c" => $uid_c, "uid_p" => $uid2_p];
        }
        require_once '../include/return_data.php';
    }
} else {
    echo json_encode(0);
}
