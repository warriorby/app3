<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$role = $arr['role'];
$type = $arr['balance_type']; //0:30/月；1:168/半年；2:298/一年

if (isset($uid) && isset($role) && isset($type)) {
    switch ($type) {
        case 1:
            $d2b->update("user_main",["balance[+]"=>30],["uid"=>$uid],["role"=>$role]);
            break;
        case 2:
            $d2b->update("user_main",["balance[+]"=>168],["uid"=>$uid],["role"=>$role]);
            break;
        case 3:
            $d2b->update("user_main",["balance[+]"=>298],["uid"=>$uid],["role"=>$role]);
            break;
        default:
            echo json_encode(0);
            break;
    }
    $return_arr = array("uid" => $uid, "role" => $role);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}