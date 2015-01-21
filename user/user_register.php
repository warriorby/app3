<?php
require("../include/conn.php");
require("../include/get_data.php");

$phone = $arr['phone'];
$pwd = $arr['password'];
$login_type = $arr['login_type'];
$channel_id = $arr['channelid'];

if (isset($phone) && isset($pwd) && isset($login_type)) {
    $datas = $d2b->select("user_main", ["phone"], ["phone" => $phone]);
    if (count($datas) == 0) {
        $timestamp = time();
        $pwd = hash('sha256', $pwd);
        $d2b->query("BEGIN");
        switch ($login_type) {
            case 2:
                $data_arr = ["phone" => $phone, "password" => $pwd, "created_time" => $timestamp, "last_login" => $timestamp, "role" => 1, "status" => 1, "channelid" => $channel_id];
                $uid_p = $d2b->insert("user_main", $data_arr);
                $data_arr2 = ["phone" => $phone, "password" => $pwd, "created_time" => $timestamp, "last_login" => $timestamp, "role" => 2, "status" => 1];
                $uid_c = $d2b->insert("user_main", $data_arr2);
                //other
                $d2b->insert("user_log", ["uid" => $uid_p, "updated" => $timestamp, "descr" => "p端注册"]);
                $d2b->insert("user_log", ["uid" => $uid_c, "updated" => $timestamp, "descr" => "p端注册"]);
                $d2b->insert("user_relation", ["uid_c" => $uid_c, "to_uid" => $uid_p, "relation" => 1]);
                $d2b->insert("user_location_log", ["uid" => $uid_c, "position_y" => 999, "position_x" => 999, "updated" => $timestamp]);
                $d2b->insert("user_im_group",["uid"=>$uid_p,"role"=>1]);
                $d2b->insert("user_im_group",["uid"=>$uid_c,"role"=>2]);
                $d2b->insert("user_education",["uid"=>$uid_p]);
                $d2b->insert("user_education",["uid"=>$uid_c]);
                $d2b->insert("user_profile",["uid"=>$uid_p]);
                $d2b->insert("user_profile",["uid"=>$uid_c]);
                $return_arr = ["uid_p" => $uid_p, "uid_c" => $uid_c, "role" => 1];
                require("../IM/im_init.php");
                $options = [["username" => $uid_p, "password" => $uid_p], ["username" => $uid_c, "password" => $uid_c]];
                $data = $easeMob->accreditRegister($options);
                break;
            case 1:
                $data_arr3 = ["phone" => $phone, "password" => $pwd, "created_time" => $timestamp, "last_login" => $timestamp, "role" => 2, "status" => 1, "channelid" => $channel_id];
                $uid_c = $d2b->insert("user_main", $data_arr3);
                //other
                $d2b->insert("user_log", ["uid" => $uid_c, "updated" => $timestamp, "descr" => "c端注册"]);
                $d2b->insert("user_relation", ["uid_c" => $uid_c, "relation" => 0]);
                $d2b->insert("user_location_log", ["uid" => $uid_c, "position_y" => 999, "position_x" => 999, "updated" => $timestamp]);
                $d2b->insert("user_im_group",["uid"=>$uid_c,"role"=>2]);
                $d2b->insert("user_education",["uid"=>$uid_c]);
                $d2b->insert("user_profile",["uid"=>$uid_c]);
                $return_arr = ["uid_c" => $uid_c, "role" => 2];
                require("../IM/im_init.php");
                $options = ["username" => $uid_c, "password" => $uid_c];
                $data = $easeMob->accreditRegister($options);
                break;
            default:
                echo json_encode(0);
                break;
        }
        if ($data['status'] == 200) {
            $d2b->query("COMMIT");
            include("../include/return_data.php");
        } else {
            $d2b->query("ROLLBACK");
            echo json_encode(-102);
        }
    } else {
        echo json_encode(-101);
    }
} else {
    echo json_encode(0);
}
