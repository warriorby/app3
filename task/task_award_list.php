<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$role = $arr['role'];
if (isset($uid) && isset($role)) {
    switch($role){
        case 1:
            $return_arr = $d2b->select("task_award","*",["uid"=>$uid]);
            break;
        case 2:
            $rs_arr = $d2b->select("user_relation",["to_uid"],["uid_c"=>$uid]);
            $uid_p = $rs_arr[0]['to_uid'];
            $return_arr = $d2b->select("task_award","*",["uid"=>$uid_p]);
            break;
        default:
            echo json_encode(0);
            break;
    }
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
